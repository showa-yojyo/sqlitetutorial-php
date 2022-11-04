# README

[SQLite PHP](https://www.sqlitetutorial.net/sqlite-php/) 個人的学習用リポジトリー。

## Requirements

WSL で学習をしている。PHP を必要ならインストールする。例：

```console
bash$ sudo apt install --no-install-recommends php8.1 php8.1-sqlite3
```

次に Composer をインストールする（同時に行ってもかまわない）。例：

```console
bash$ sudo apt install composer
```

以上が第一回 [SQLite PHP: Establish a Connection to SQLite Database](https://www.sqlitetutorial.net/sqlite-php/connect/)
完了に必要だ。

[SQLite PHP: Write, Read, and Update BLOB Data](https://www.sqlitetutorial.net/sqlite-php/blob/) を完遂するには
PDF ファイルと PNG ファイルを一つずつ必要とする。適当に用意して `assets` フォルダーに置けばいい。
PHP でのファイル名を `test.pdf`, `test.png` に変更しておいた。

## Workflow

VS Code にサーバー稼働と `composer update` それぞれを一発で実行するタスクを用意した。
これらを適宜呼び出してからブラウザーを開いて動作確認をする。
