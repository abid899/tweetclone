<x-app-layout>
    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- alert --}}
         @if(session('success'))
                      <div class="alert alert-success mb-3 alertMessage duration-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{session('success')}}</span>
                        <a href="" class="closed-alert" onclick="closedAlert()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                        </a>
                      </div>
         @endif
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
                           <div class="card-body text-black">
                            {{$item->content}}
                        @if ($item->image)
                            <button onclick="">
                              <img src="{{asset('storage/images/'.$item->image)}}" class="w-2/6" id="image-twets"/>
                            </button>
                        @endif
                        </div> 
                        <div class="ps-5 pb-3">
                            <form action="{{ route('coment', $item->id)}}" method="post">
                                @csrf
                                <input type="text" name="coment" />
                                <button class="btn btn-succes h-4 text-xs w-20" type="submit">comment</button>
                            </form>
                        </div>
                       
                        <div class=" text-xl text-black ps-5 pb-3 font-bold">({{$coment_length}}) Comments</div>
                        @foreach ($comments as $coment)
                        {{-- coment --}}
                        @if ($coment->isComents())
                            <div class="comments">
                              <div class="coment-header flex  mt-2">
                                <div class="avatar placeholder ps-5 pr-2 ">
                                    <div class="bg-neutral-focus text-neutral-content rounded-full w-8">
                                        <span>MX</span>
                                    </div>
                                </div>
                                <div class="  font-black text-black text-base pr-8  ">{{$coment->user->name}}</div>
                                <div class="  text-sm text-black font-semibold pt-0.5 ">{{$coment->created_at}}</div>
                            </div>
                       
                           
                         
                            <div class="coment-body mb-3 ">
                                <div class="ps-14 pb-">{{$coment->body}}</div>
                                <div class="button-group ps-12 flex">
                                    <button class="btn btn-info btn-xs h-8 text-xs w-14 ">Balas</button>
                                  @if ($coment->isUser())
                                    <button class="btn btn-primary btn-xs h-8 text-xs w-14">Edit</button>
                                    <form action="{{route('delete.coment',$coment->id)}}" method="post" >
                                      @csrf
                                      <button type="submit" class="btn btn-warning btn-xs h-8 text-xs w-14" onclick="confirm()">Hapus</button>
                                    </form>
                                  @endif
                                    <button class="btn bg-red-600 btn-xs border-none h-8 text-xs text-slate-100 ">
                                      <svg xmlns="http://www.w3.org/2000/svg" height=".8em" viewBox="0 0 512 512" class="fill-white"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/></svg> 5
                                    </button>
                                </div>
                            </div>
                         @endif
                            {{-- balas comment --}}
                         
                         @if (!$coment->isComents() )
                            <div class="balas ms-10">
                                <div class="coment-header flex  mt-2">
                                <div class="avatar placeholder ps-5 pr-2 ">
                                    <div class="bg-neutral-focus text-neutral-content rounded-full w-8">
                                        <span>MX</span>
                                    </div>
                                </div>
                                <div class="  font-black text-black text-base pr-8  ">{{$coment->user->name}}</div>
                                <div class="  text-sm text-black font-semibold pt-0.5 ">{{$coment->created_at}}</div>
                                </div>
                                <div class="coment-body mb-3 ">
                                    <div class="ps-14 pb-3">{{$coment->body}}</div>
                                    <div class="button-group ps-12">
                                        {{-- <button class="btn btn-info btn-xs h-9 w-14">Balas</button> --}}
                                        <button class="btn btn-primary btn-xs h-8 text-xs w-14">Edit</button>
                                        <button class="btn btn-warning btn-xs h-8 text-xs w-14">Hapus</button>
                                        <button class="btn bg-red-600 btn-xs border-none h-8 text-xs text-slate-100 mt-1">
                                          <svg xmlns="http://www.w3.org/2000/svg" height=".8em" viewBox="0 0 512 512" class="fill-white"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/></svg> 5
                                        </button>
                                    </div>
                                </div>
                            </div>
                         @endif
                            <hr class="text-sm text-black mt-3"/>
                           </div>
                        @endforeach
                        {{-- end comment  --}}
                      
                       </div> 
                 </div>
         @endforeach
            
        </div>
    </div>
</x-app-layout>
@slot('scipts')
   <script>
      function confirm(){
        return confirm('hapus coment')
      }
   </script>
@endslot
