# テンファイブ採用サイト - クリーン版ワークスペース

## 新しいワークスペースの準備完了！

### 📁 ディレクトリ構成

```
tenfive-recruit-clean/
├── 📄 index.html                    # トップページ（完成済み）
├── 📁 assets/                       # 静的アセット
│   ├── 📁 images/                   # 画像ファイル
│   └── 📁 icons/                    # アイコンファイル
├── 📁 css/                          # スタイルシート
│   ├── 🎨 design-system.css         # デザインシステム基盤
│   ├── 🧩 components.css            # コンポーネントスタイル
│   ├── 🃏 card-system.css           # カードシステム
│   ├── 📄 sections.css              # セクションスタイル
│   └── 🔢 numbers.css               # 数字ページ専用スタイル
├── 📁 js/                           # JavaScript
│   └── ⚡ main.js                   # メインスクリプト
├── 📁 pages/                        # 下層ページ
│   ├── 📁 features/                 # 特徴ページ
│   │   ├── 📁 in-numbers/           # ✅ 数字で見るテンファイブ（サンプル完成）
│   │   └── 📁 industry-analysis/    # 業界分析
│   ├── 📁 workstyle/                # 働き方・キャリアパス
│   │   ├── 📁 career-path/          # キャリアパス
│   │   ├── 📁 schedule/             # スケジュール
│   │   └── 📁 events/               # 社内イベント
│   ├── 📁 selection/                # 選考について
│   │   ├── 📁 ideal-candidate/      # 求める人物像
│   │   ├── 📁 new-grad/             # 新卒採用
│   │   └── 📁 mid-career/           # キャリア採用
│   └── 📁 company/                  # 会社紹介
│       ├── 📁 overview/             # 会社概要
│       ├── 📁 members/              # メンバー
│       └── 📁 history/              # ヒストリー
├── 📁 templates/                    # ページテンプレート
│   ├── 📄 page-template.html        # 基本ページテンプレート
│   ├── 📄 section-template.html     # セクションテンプレート
│   ├── 📄 component-template.html   # コンポーネントテンプレート
│   └── 📖 development-guide.md      # 開発ガイド
├── 📁 design-tokens/                # デザイントークン
└── 📖 README.md                     # プロジェクト説明
```

## 🚀 開発開始手順

### 1. ワークスペースの切り替え
```bash
cd /Users/shirakamitakayuki/DesignSystem/tenfive-recruit-clean
```

### 2. ローカルサーバーの起動
```bash
# Python 3の場合
python -m http.server 8000

# Node.jsの場合
npx serve .

# または、Live Server拡張機能を使用
```

### 3. ブラウザで確認
- トップページ: `http://localhost:8000/index.html`
- サンプルページ: `http://localhost:8000/pages/features/in-numbers/index.html`

## 📋 次のステップ

### 優先度の高いページ
1. **特徴ページ**
   - ✅ 数字で見るテンファイブ（完成）
   - 🔄 業界構造から見た強み

2. **働き方・キャリアパス**
   - 🔄 キャリアパス
   - 🔄 1週間のスケジュール
   - 🔄 社内イベント

3. **選考について**
   - 🔄 求める人物像
   - 🔄 新卒採用（FAQ、フロー、募集要項）
   - 🔄 キャリア採用（FAQ、フロー、募集要項）

4. **会社紹介**
   - 🔄 会社概要
   - 🔄 メンバー
   - 🔄 ヒストリー

## 🛠️ 開発ツール

### テンプレートの使用
```bash
# 新しいページを作成する場合
cp templates/page-template.html pages/[カテゴリ]/[ページ名]/index.html
```

### デザインシステムの活用
- カラーパレット: `--color-primary-500`, `--color-secondary-500`
- スペーシング: `--spacing-4`, `--spacing-8`, `--spacing-16`
- タイポグラフィ: `.heading-1`, `.heading-2`, `.body-regular`

### コンポーネントの使用
- カード: `.image-card`, `.featured-card`, `.selection-card`
- ボタン: `.btn btn--primary`, `.btn btn--outline`
- セクション: `.section`, `.section__header`, `.section__title`

## 📚 参考資料

- `templates/development-guide.md` - 詳細な開発ガイド
- `design-tokens/` - デザイントークン定義
- `css/design-system.css` - デザインシステム基盤

## 🎯 開発のポイント

### デザインシステム準拠
- 既存のCSS変数を使用
- コンポーネントの再利用を心がける
- 一貫したスペーシングとタイポグラフィ

### アクセシビリティ
- 適切なHTMLセマンティクス
- `alt`属性と`aria-label`の設定
- キーボードナビゲーション対応

### レスポンシブ対応
- モバイルファーストのアプローチ
- ブレークポイントの適切な使用
- 画像の最適化

## 🔄 継続的な改善

- パフォーマンスの最適化
- アクセシビリティの向上
- ユーザビリティの改善
- デザインシステムの拡張

---

**準備完了！** 効率的な下層ページ開発を開始しましょう！ 🚀
