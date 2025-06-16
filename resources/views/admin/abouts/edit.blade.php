<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit About') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg"> 
                
                <form method="POST" action="{{ route('admin.abouts.update', $about) }}" enctype="multipart/form-data"> 
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                          value="{{ $about->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('thumbnail')" />
                        <img src="{{ Storage::url($about->thumbnail) }} " alt="" class="rounded-2xl object-cover w-[90px] h-[90px]">
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="type" :value="__('type')" />
                        
                        <select name="type" id="type" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="Visions" {{ $about->type == 'Visions' ? 'selected' : '' }}>Visions</option>
                            <option value="Missions" {{ $about->type == 'Missions' ? 'selected' : '' }}>Missions</option>
                        </select>

                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <h3 class="text-indigo-950 text-lg font-bold mt-4">Keypoints</h3>
                    <div class="mt-4">
                        @forelse ($about->keypoints as $keypoint)
                            <div class="flex flex-col gap-y-5">
                                <x-input-label for="keypoints" :value="__('keypoints')" /> 
                                <input type="text" class="py-3 rounded-lg border-slate-300 border" 
                                       value="{{ $keypoint->keypoint }}" name="keypoints[]">
                            </div>
                        @empty
                        @endforelse
                        <x-input-error :messages="$errors->get('keypoints')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
            
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update About
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
