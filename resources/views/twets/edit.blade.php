<x-app-layout>
     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('update.twets',$twets->id)}}" class="form-control" method="post">
                        @csrf
                        @method('put')
                        <textarea name="content" id="" cols="30" rows="3" 
                        class="textarea textarea-bordered textarea-ghost @error('content') textarea-error @enderror" placeholder="Tuliskan tweets...">{{$twets->content}}</textarea>
                        @error('content')
                          <span class="text-rose-700	">{{$message}}</span>
                        @enderror
                        <div class="grid justify-items-end">
                          <button type="submit" class="btn btn-primary mt-2 w-24">Update</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
     </div>
</x-app-layout>