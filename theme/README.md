# Wordpress開発テーマ

- フロントエンドチームがWordpressテーマ開発に使用するフレームワークです。
- update 2023/06/29


## Feature

- ローカルサーバ機能
- LiveReload
- SASS -> CSS変換
- CSSのベンダープレフィックス付与
- CSSプロパティの並び替え
- CSSの整形
- CSSソースマップ出力
- JSファイルの結合
- 画像の圧縮
- 開発・本番でのタスク切替え
  - 開発時に実行：ソースマップ出力
  - 本番時に実行：ソースマップ削除

## Dependences

- NodeJS 16.18.0 以上
- npm 8.19.2 以上

## Usage

### 初期設定

### インストール

package.json の情報から各種node_modulesをインストールします。

```
npm i
```

### 開発用ビルド

- 作業効率を優先し、ソースマップを出力します。

```
npm run start
```

### リリース用ビルド

- ソースマップは削除し、再度ビルドします。

```
npm run production
```

# 開発の流れ

1. `style.css` に必要な情報を入力して、Wordpress管理画面からテーマ切り替え


