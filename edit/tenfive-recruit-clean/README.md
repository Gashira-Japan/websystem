# テンファイブ採用サイト - クリーン版

## 概要
デザインシステムに基づいたテンファイブ採用サイトのクリーンな開発環境です。

## ディレクトリ構成

```
tenfive-recruit-clean/
├── assets/                 # 静的アセット
│   ├── images/            # 画像ファイル
│   └── icons/             # アイコンファイル
├── css/                   # スタイルシート
│   ├── design-system.css  # デザインシステム基盤
│   ├── components.css     # コンポーネントスタイル
│   ├── card-system.css    # カードシステム
│   ├── sections.css       # セクションスタイル
│   └── ...
├── js/                    # JavaScript
│   └── main.js           # メインスクリプト
├── pages/                 # 下層ページ
│   ├── features/         # 特徴ページ
│   │   ├── in-numbers/   # 数字で見るテンファイブ
│   │   └── industry-analysis/ # 業界分析
│   ├── workstyle/        # 働き方・キャリアパス
│   │   ├── career-path/  # キャリアパス
│   │   ├── schedule/     # スケジュール
│   │   └── events/       # 社内イベント
│   ├── selection/        # 選考について
│   │   ├── ideal-candidate/ # 求める人物像
│   │   ├── new-grad/     # 新卒採用
│   │   └── mid-career/   # キャリア採用
│   └── company/          # 会社紹介
│       ├── overview/     # 会社概要
│       ├── members/      # メンバー
│       └── history/      # ヒストリー
├── components/           # 再利用可能コンポーネント
├── templates/           # ページテンプレート
├── design-tokens/       # デザイントークン
└── index.html          # トップページ
```

## 開発方針

### デザインシステム準拠
- 統一されたカラーパレット
- 8pxベースのスペーシングシステム
- 一貫したタイポグラフィ
- 再利用可能なコンポーネント

### アクセシビリティ
- WCAG 2.1 AA準拠
- キーボードナビゲーション対応
- スクリーンリーダー対応
- フォーカス管理

### パフォーマンス
- 最適化された画像
- 効率的なCSS
- 軽量なJavaScript
- レスポンシブデザイン

## 開発開始

1. ローカルサーバーを起動
2. ブラウザで `index.html` を開く
3. 下層ページの開発を開始

## 下層ページ開発

各下層ページは以下のテンプレートを使用：
- `templates/page-template.html` - 基本ページテンプレート
- `templates/section-template.html` - セクションテンプレート
- `templates/component-template.html` - コンポーネントテンプレート
