<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Diskominfo Bantul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mb-3">Test Diskominfo Bantul</h1>

        @php
            $currentFilter = $_GET['filter'];
        @endphp
        <form action="/pokemons" method="GET">
            <div class="input-group mb-3">
                <select class="form-select" name="filter">
                    <option value="all" @if ($currentFilter == 'all') selected @endif>All</option>
                    <option value="heavy" @if ($currentFilter == 'heavy') selected @endif>Heavy</option>
                    <option value="light" @if ($currentFilter == 'light') selected @endif>Light</option>
                    <option value="medium" @if ($currentFilter == 'medium') selected @endif>Medium</option>
                </select>
                <button type="submit" class="btn btn-outline-secondary">Filter</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Name</td>
                    <td>Base Experience</td>
                    <td>Weight</td>
                    <td>Ability</td>
                    <td>Image</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($pokemons as $index => $pokemon)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pokemon->name }}</td>
                    <td>{{ $pokemon->base_experience }}</td>
                    <td>{{ $pokemon->weight }}</td>
                    <td>
                        <ul>
                            @foreach ($pokemon->abilities as $ability)
                            <li>{{ $ability->ability_name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td><img src="{{ asset('storage/'.$pokemon->image_path) }}" alt="{{ $pokemon->name }}" width="100">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $pokemons->links() }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
