# 旧WordPress → 新設計 対応表

## テンプレート対応

### 旧WPテンプレート → 新テンプレート
- `page.php` → `templates/page-template.html`
- `single.php` → `templates/page-template.html`
- `header.php` → `templates/page-template.html` (header部分)
- `footer.php` → `templates/page-template.html` (footer部分)
- `sidebar.php` → 廃止（新設計では使用しない）

### セクションテンプレート
- カスタムセクション → `templates/section-template.html`
- ヒーローセクション → `templates/subpage-hero-template.html`

## クラス名対応

### 旧WPクラス → 新クラス
```css
/* レイアウト */
.wp-container → .container
.wp-block-group → .section
.wp-block-columns → .cards-grid

/* カード */
.wp-block-media-text → .image-card
.wp-block-cover → .featured-card
.wp-block-group__inner-container → .card__content

/* ナビゲーション */
.menu-item → .nav__item
.menu-item a → .nav__link
.sub-menu → .nav__dropdown

/* ボタン */
.wp-block-button → .btn
.wp-block-button__link → .btn__link
.is-style-outline → .btn--outline
```

## 画像・アセット対応

### 旧WP画像パス → 新パス
```
/wp-content/uploads/ → /tenfive-recruit-clean/assets/images/
```

### 重要な画像ファイル
- ロゴ: `recruit-logo.svg`
- 会社画像: `company.jpg`, `company-history.jpg`
- メンバー画像: `staff-*.jpg`
- イベント画像: `events.webp`

## コンテンツ対応

### ページ構成
- **ホーム** → `index.html`
- **数字で見るテンファイブ** → `pages/in-numbers.html`
- **業界構造** → `pages/ses-sier-industry-structure.html`
- **キャリアパス** → `pages/career-path.html`
- **スケジュール** → `pages/schedule.html`
- **イベント** → `pages/events.html`
- **求める人物像** → `pages/ideal-candidate.html`
- **FAQ** → `pages/faq.html`
- **会社概要** → `pages/company.html`
- **ヒストリー** → `pages/history.html`

### セクション構成
各ページは以下のセクションで構成：
1. ヒーローセクション（`hero--subpage`）
2. メインコンテンツセクション
3. CTAセクション（必要に応じて）

## スタイル対応

### 旧WPスタイル → 新CSS
```css
/* 旧WP */
.wp-block-group__inner-container {
  padding: 2rem;
}

/* 新設計 */
.section {
  padding: var(--spacing-section-padding) 0;
}
```

### カラーパレット移行
```css
/* 旧WP（推測） */
color: #0073aa; → var(--color-primary-500);
color: #00a32a; → var(--color-secondary-500);
color: #d63638; → var(--color-error-500);
```

## 機能対応

### 旧WP機能 → 新実装
- **カスタムフィールド** → 静的コンテンツ
- **ウィジェット** → コンポーネント化
- **ショートコード** → テンプレート変数
- **プラグイン** → バニラJS実装

### ナビゲーション
- **メガメニュー** → CSS Grid + JavaScript
- **ドロップダウン** → `nav__dropdown`クラス
- **モバイルメニュー** → ハンバーガーメニュー

## データ移行

### コンテンツソース
- **テキスト** → `ascii-md/` フォルダのMarkdownファイル
- **画像** → `assets/images/` フォルダ
- **設定** → `design-tokens/` フォルダ

### 重要なデータファイル
- `ascii-md/01_in-numbers_ascii.md` - 数字データ
- `ascii-md/02_ses-sier-industry-structure_ascii.md` - 業界分析
- `ascii-md/03_career-path_ascii.md` - キャリアパス
- `ascii-md/04_schedule_ascii.md` - スケジュール
- `ascii-md/05_event_ascii.md` - イベント情報

## 注意事項

1. **旧WPの独自CSS/JSは基本持ち込まない**
2. **必要時は「移植理由」をPR本文に記載**
3. **画像・文言は「出典」を記録**
4. **既存コンポーネントを優先使用**
5. **デザイントークンのみ使用**
