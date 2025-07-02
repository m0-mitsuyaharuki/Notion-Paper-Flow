<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->string('original_filename');
            # とりあえずはtableに論文の英語と翻訳文をそのまま入れる仕組みで
            $table->string('original_text');
            $table->string('translated_text');
            # できそうだったらtableには入れずに，ローカルにテキストファイルとして入れておいて，それのパスを参照して表示するみたいにしたい
            $table->string('original_file_path');
            $table->string('translated_file_path');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papers');
    }
};
