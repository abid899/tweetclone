<x-app-layout>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                      <div class="alert alert-success mb-3 alertMessage duration-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{session('success')}}</span>
                        <a href="" class="closed-alert" onclick="closedAlert()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                        </a>
                      </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('create.twets')}}" class="form-control" method="post" enctype="multipart/form-data">
                        @csrf
                        <textarea name="content" id="" cols="30" rows="3" 
                        class="textarea textarea-bordered textarea-ghost @error('content') textarea-error @enderror" placeholder="Tuliskan tweets..."></textarea>
                        
                        <img id="previewImage" src="" alt="Preview Image" style="display: none; width:200px" class="mt-1">
                        <input type="file" id="inputFile" name="image" class="mt-2">
                       
                        @error('content')
                          <span class="text-rose-700	">{{$message}}</span>
                        @enderror
                        <div class="grid justify-items-end">
                          <button type="submit" class="btn btn-primary mt-2 w-24">Tweets</button>
                        </div>
                    </form> 
                </div>
            </div>

            
                 @foreach ($twets as $item)
                 <div class=" bg-white shadow-sm sm:rounded-lg">
                       <div class="card bg-white mt-2 border-solid border-sky-500">
                        <div class="card-header flex">
                          <div class="avatar placeholder p-3">
                            <div class="bg-neutral-focus text-neutral-content rounded-full w-8">
                                <span>MX</span>
                            </div>
                          </div> 
                        <div class="card-title pt-1 font-black text-black text-base  ">{{$item->user->name}}</div>
                        <div class="created ml-52 mt-7 text-xs">{{$item->created_at}}</div>
                        </div>
                        <a href="{{route('show.twets',$item->slug)}}">
                           <div class="card-body text-black">
                            {{$item->content}}
                        @if ($item->image)
                            <button onclick="">
                              <img src="{{asset('storage/images/'.$item->image)}}" class="w-2/6" id="image-twets"/>
                            </button>
                        @endif
                        </div>
                        </a>
                       </div> 
                 </div>
                 @endforeach
        </div>
    </div>
    @push('scripts')
    <script>
      closedAlert = () => {
        const alertElement = document.getElementById('alertMessage');
        alertElement.style.display = 'none';
      }

    const inputFile = document.getElementById('inputFile');
    const previewImage = document.getElementById('previewImage');

    inputFile.addEventListener('change', function() {
        const file = inputFile.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            previewImage.src = reader.result;
            previewImage.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
            previewImage.style.display = 'none';
        }
    });

// image detail
     
    const showImage = () => {
        const img = getElementById = 'image-twets'
        const src = img.src
        console.log(src)
    }

    </script>
   @endpush
</x-app-layout>
