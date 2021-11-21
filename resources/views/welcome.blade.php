<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body>
        <div class="container-fluid p-5 bg-primary text-white text-center">
            <h1>Laravel short link generator</h1>
            <p>First page -)</p>
        </div>
        <div class="container mt-5">
            <h2>Enter link parameters</h2>
            <form action="{{ route('add_link') }}" method="post">
                @csrf
                <input
                    type="hidden"
                    name="token"
                    value="{{ \App\Helpers\StrHelper::randomToken() }}"
                >
                <div class="row mb-2">
                    <div class="form-group col-sm-4">
                        <label for="url">Url:</label>
                        <input class="form-control @error('url') is-invalid @enderror" id="url" placeholder="" name="url" required>
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="max_visit">Max. Visit:</label>
                        <input type="number" class="form-control @error('max_visit') is-invalid @enderror" id="max_visit" placeholder="" name="max_visit" value="0" required>
                        @error('max_visit')
                             <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="life_time">Life time (h):</label>
                        <input type="number" step="0.1" class="form-control @error('life_time') is-invalid @enderror" id="life_time" placeholder="" name="life_time" value="1" min="0.1" max="24" required>
                        @error('life_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
                <button type="submit" class="btn btn-primary ">Submit</button>
            </form>


            <table class="table table-hover mt-5">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Url</th>
                    <th scope="col">Visited</th>
                    <th scope="col">Max. Visit</th>
                    <th scope="col">Life Time (h)</th>
                    <th scope="col">Created at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($links as $key => $value)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td><a href="{{ URL::to($value->token)  }}">{{ $value->url }}</a></td>
                        <td>{{ $value->total_visit }} </td>
                        <td {{ \App\Helpers\UrlHelper::maxVisitDetect($value) ? 'class=text-danger' : 'class=text-success' }}>{{ $value->max_visit }}</td>
                        <td {{ \App\Helpers\UrlHelper::expire($value) ? 'class=text-danger' : 'class=text-success' }}>{{ $value->life_time }}</td>
                        <td>{{ $value->created_at->format('Y-m-d h:m') }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $links->links() !!}
            </div>
        </div>
    </body>
</html>
