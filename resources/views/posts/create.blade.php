<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('新しい論文をアップロード') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    {{-- エラー表示 --}}
                    @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">おや、何か問題があるようです。</strong>
                        <ul class="mt-3 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- ファイルアップロードフォーム --}}
                    {{-- ファイルを扱うため、enctype="multipart/form-data" は必須です --}}
                    <form action="{{ route('papers.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div>
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">論文タイトル</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">論文ファイル</label>
                            <div id="dropzone"
                                class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors duration-200 ease-in-out">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <p class="pl-1">ここにファイルをドラッグ＆ドロップするか、<span
                                                class="font-medium text-indigo-600 dark:text-indigo-400">クリックしてファイルを選択</span>してください。
                                        </p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-500">PDF, DOCX, TXT (最大10MB)</p>
                                </div>
                                {{-- 実際のファイル入力フィールド。見た目上は隠しておく --}}
                                <input id="file-upload" name="paper_file" type="file" class="hidden">
                            </div>
                            {{-- 選択されたファイル名を表示するエリア --}}
                            <div id="file-info" class="hidden mt-3 text-sm text-gray-700 dark:text-gray-300">
                                <p>選択中のファイル: <span id="filename" class="font-semibold"></span></p>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                アップロード
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ドラッグ＆ドロップとファイル選択を処理するためのJavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dropzone = document.getElementById('dropzone');
            const fileUpload = document.getElementById('file-upload');
            const fileInfo = document.getElementById('file-info');
            const filenameSpan = document.getElementById('filename');

            // Dropzoneがクリックされたら、隠されたファイル入力を発火させる
            dropzone.addEventListener('click', () => {
                fileUpload.click();
            });

            // ファイルが選択された時の処理
            fileUpload.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    handleFile(e.target.files[0]);
                }
            });

            // ドラッグオーバー時のスタイル変更
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault(); // デフォルトの動作をキャンセル
                dropzone.classList.add('border-indigo-500', 'bg-indigo-50', 'dark:bg-gray-700');
            });

            // ドラッグがエリアから離れた時のスタイルを元に戻す
            dropzone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dropzone.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-gray-700');
            });

            // ファイルがドロップされた時の処理
            dropzone.addEventListener('drop', (e) => {
                e.preventDefault(); // デフォルトの動作をキャンセル
                dropzone.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-gray-700');

                // ドロップされたファイルをinputに設定し、ファイル情報を表示
                if (e.dataTransfer.files.length > 0) {
                    fileUpload.files = e.dataTransfer.files;
                    handleFile(e.dataTransfer.files[0]);
                }
            });

            // ファイル情報を表示する共通関数
            function handleFile(file) {
                filenameSpan.textContent = file.name;
                fileInfo.classList.remove('hidden');
            }
        });
    </script>
</x-app-layout>