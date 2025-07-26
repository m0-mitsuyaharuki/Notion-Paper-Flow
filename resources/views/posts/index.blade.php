<x-app-layout>
    <x-slot name="header">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('論文一覧') }}
            </h2>
            
            <button onclick="window.location.href='{{ route('create') }}'"
                class="px-4 py-2 bg-indigo-500 text-white rounded-md">
                {{ __('新しい論文をアップロード') }}
            </button>
        </div>
    </x-slot>

    <div class="py-12"> {{-- 上下のパディングを追加 --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> {{-- コンテンツの最大幅と中央寄せ--}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> {{-- 背景白、影、角丸 --}}
                <div class="p-6 text-gray-900"> {{-- 内部パディング、テキスト色 --}}

                    <!-- <h1 class="text-3xl font-bold mb-6 text-gray-800">Blog Name</h1> {{-- 大きな見出し、太字、下マージン --}} -->

                    <div class='posts grid grid-cols-1 md:grid-cols-2 gap-6'> {{-- グリッドレイアウト、中サイズ以上で2カラム、要素間のギャップ --}}
                        @foreach ($papers as $paper)
                            <div class='post bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200'> {{-- 薄い灰色の背景、パディング、角丸、影、ボーダー --}}
                                <h2 class='title text-xl font-semibold mb-2 text-indigo-700'>{{ $paper->title }}</h2> {{-- 見出しサイズ、太字、下マージン、色 --}}
                                <div class="grid grid-cols-2 gap-4 text-sm"> {{-- 翻訳テキストを2カラムに --}}
                                    <div class='original-text-column'>
                                        <p class='body text-gray-700 leading-relaxed'>{{ $paper->original_text }}</p> {{-- テキスト色、行の高さ --}}
                                    </div>
                                    <!--  <div class='translated-text-column'>
                                        <p class='body text-gray-700 leading-relaxed'>{{ $paper->translated_text }}</p> {{-- テキスト色、行の高さ --}}
                                    </div>  -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>