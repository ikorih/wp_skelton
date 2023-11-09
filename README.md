# WordPress Starter Emvironment Width Docker

DockerによるWordpressのローカル環境を構築するセット

Contents:

- [Requirements](#requirements)
- [Configuration](#configuration)
- [Installation](#installation)
- [Usage](#usage)

## Requirements

docker, docker-composeの最新版が入っていること。

## Configuration

`.env`に環境変数を定義します。
envに雛形を記載してますので適宜変更しファイル名を.envに変更してください。

## Installation

docker-composeで関連コンテナを起動します。
```
$ docker-compose up -d
```

２つのディレクトリが生成されます。

* `data` – データベースのdumpデータ用です。
* `app` – 実際に開発用のWordpressが入ります。

コマンド入力後、`http://localhost:8000`でブラウザからアクセスができます。

## Usage

### コンテナの起動
```
$ docker-compose up -d
```
### コンテナの停止
```
$ docker-compose stop
```

### 開発環境の消去
```
$ docker-compose down -v
```

### データベースのdumpデータの作成
```
$ ./export.sh
```
`data/mysql`にdumpデータが保存されます。
一度dumpデータを書き出すと、次回からのコンテナ起動時に自動でdumpデータからの復元を行います。

### WP CLI

WP:cliのコマンド利用可能です。
```
$ docker-compose run --rm cli wp 【コマンド】
```
コマンド一覧 → https://developer.wordpress.org/cli/commands/
以下サンプル
```
$ docker-compose run --rm cli wp core install --url=http://localhost --title=test --admin_user=admin --admin_email=test@example.com
```

### Wordmove

以下のコマンドにてコンテナに接続
```
#{プレフィックス}には.envの[PRODUCTION_NAME]に指定した値が入ります。
$ docker exec -it {プレフィックス}_wordmove /bin/bash
```

ホームディレクトリに移動
```
$ cd /home/
```
```
$ wordmove doctor
```

 
 
