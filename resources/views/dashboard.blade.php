<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row p-4">
                    <div class="col-8">
                        <form action="{{route("generate_url")}}"
                              method="post"
                        >
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="website_url" class="form-label">Your Website Url</label>
                                <input type="text"
                                       class="form-control"
                                       id="website_url"
                                       name="website_url"
                                >
                            </div>
                            <button class="btn btn-primary">Create URL</button>
                        </form>
                    </div>
                    <div class="col-4 text-right">
                        <form action="{{route("upload_links")}}"
                              method="post"
                              enctype="multipart/form-data"
                        >
                            @csrf

                            <div class="mb-3">
                                <label for="file" class="form-label">Upload CSV File</label>
                                <input type="file"
                                       class="form-control"
                                       id="file"
                                       name="file"
                                >
                            </div>
                            <button class="btn btn-primary">Upload CSV</button>
                        </form>
                        <form action="{{route("download_file")}}"
                              method="post"
                        >
                            @csrf
                            <input type="hidden"
                                   name="perPage"
                                   value="1"
                            >
                            <button class="btn btn-secondary mt-5">Download All</button>
                        </form>
                    </div>
                </div>
                @isset($success)
                    <div class="alert alert-success">
                        <p>{{$success}}</p>
                    </div>
                @endif
                <hr class="mb-5"/>
                @include("components/table", ['links' => $links])
                <div class="mt-5 p-4">
                    {!! $links->links() !!}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
