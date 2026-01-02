const axios = require('axios');
const { Sequelize, DataTypes } = require('sequelize');
const fs = require('fs');
const path = require('path');

const sequelize = new Sequelize('test-diskominfo-bantul', 'root', '', {
    host: 'localhost',
    dialect: 'mysql',
    logging: false
});

const Pokemon = sequelize.define('Pokemon', {
    id: { type: DataTypes.INTEGER, primaryKey: true },
    name: { type: DataTypes.STRING },
    base_experience: { type: DataTypes.INTEGER },
    weight: { type: DataTypes.INTEGER },
    image_path: { type: DataTypes.STRING }
}, { tableName: 'pokemons', timestamps: false });

const Ability = sequelize.define('Ability', {
    id: { type: DataTypes.INTEGER, primaryKey: true, autoIncrement: true },
    name: { type: DataTypes.STRING, unique: true }
}, { tableName: 'abilities', timestamps: false });

const PokemonAbility = sequelize.define('PokemonAbility', {
    pokemon_id: { type: DataTypes.INTEGER },
    abilities_id: { type: DataTypes.INTEGER }
}, { tableName: 'pokemon_ability', timestamps: false });

Pokemon.belongsToMany(Ability, { through: PokemonAbility, foreignKey: 'pokemon_id', otherKey: 'abilities_id' });
Ability.belongsToMany(Pokemon, { through: PokemonAbility, foreignKey: 'abilities_id', otherKey: 'pokemon_id' });

async function downloadImage(url, pokemonName) {
    const folderPath = path.resolve(__dirname, 'images');
    if (!fs.existsSync(folderPath)) fs.mkdirSync(folderPath);

    const fileName = `${pokemonName}.png`;
    const filePath = path.join(folderPath, fileName);
    
    const response = await axios({
        url,
        method: 'GET',
        responseType: 'stream'
    });

    return new Promise((resolve, reject) => {
        const writer = fs.createWriteStream(filePath);
        response.data.pipe(writer);
        writer.on('finish', () => resolve(`images/${fileName}`));
        writer.on('error', reject);
    });
}

async function scrapePokemon() {
    try {
        await sequelize.sync({ force: true });
        console.log("masuk");

        const response = await axios.get('https://pokeapi.co/api/v2/pokemon?limit=400');
        const pokemonList = response.data.results;

        for (let p of pokemonList) {
            const detail = await axios.get(p.url);
            const data = detail.data;

            if (data.weight > 99) {
                const imageUrl = data.sprites.other['official-artwork'].front_default;
                let localImagePath = null;

                if (imageUrl) {
                    localImagePath = await downloadImage(imageUrl, data.name);
                    console.log(`gambar disimpan: ${localImagePath}`);
                }

                const newPokemon = await Pokemon.create({
                    id: data.id,
                    name: data.name,
                    base_experience: data.base_experience,
                    weight: data.weight,
                    image_path: localImagePath
                });

                for (let ab of data.abilities) {
                    if (!ab.is_hidden) {
                        const [abilityRecord] = await Ability.findOrCreate({
                            where: { name: ab.ability.name }
                        });
                        await newPokemon.addAbility(abilityRecord);
                    }
                }
                console.log(`${data.name} berhasil disimpan.`);
            }
        }
    } catch (error) {
        console.error("Error:", error.message);
    } finally {
        await sequelize.close();
    }
}

scrapePokemon();