# デザインシステム - テンファイブ採用サイト

## カラーパレット

### プライマリカラー
```css
--color-primary-500: #228dc4;  /* メインブルー */
--color-primary-600: #0d679e;  /* ホバー・アクティブ */
--color-primary-700: #1d4ed8;   /* フォーカス */
```

### セカンダリカラー（採用サイト特徴）
```css
--color-secondary-500: #90b425;  /* 成長グリーン - 採用サイトの親しみやすさ */
--color-secondary-600: #138f8f;  /* 革新ティール - サブビジュアル用 */
```

### アクセントカラー
```css
--color-accent-500: #e6951e;  /* オレンジ - CTA・強調 */
```

### ニュートラルカラー
```css
--color-neutral-50: #f8fafc;   /* 背景 */
--color-neutral-100: #f1f5f9;  /* セクション背景 */
--color-neutral-700: #2c3e50;  /* テキスト */
--color-neutral-900: #0f172a;  /* 見出し */
--color-neutral-white: #ffffff;
```

## タイポグラフィ

### フォントファミリー
```css
--font-family-primary: 'Noto Sans JP', sans-serif;    /* メイン */
--font-family-secondary: 'Inter', sans-serif;        /* サブ */
```

### フォントサイズ階層
```css
--font-size-xs: 12px;    /* キャプション */
--font-size-sm: 14px;    /* 小テキスト */
--font-size-base: 16px;  /* ベース */
--font-size-lg: 18px;    /* 大テキスト */
--font-size-xl: 20px;    /* 小見出し */
--font-size-2xl: 24px;   /* 中見出し */
--font-size-3xl: 32px;   /* 大見出し */
--font-size-4xl: 40px;   /* 特大見出し */
--font-size-5xl: 48px;   /* ヒーロー見出し */
--font-size-6xl: 64px;   /* メインヒーロー */
```

### 見出しクラス
```css
.heading-1 { /* メインヒーロー */ }
.heading-2 { /* ページタイトル */ }
.heading-3 { /* セクションタイトル */ }
.heading-4 { /* サブセクション */ }
.heading-5 { /* カードタイトル */ }
.heading-6 { /* 小見出し */ }
```

## スペーシング・グリッド

### 8pxベースシステム
```css
--spacing-1: 4px;   /* 最小 */
--spacing-2: 8px;   /* ベース */
--spacing-4: 16px;  /* 標準 */
--spacing-6: 24px;  /* 中 */
--spacing-8: 32px;  /* 大 */
--spacing-12: 48px; /* 特大 */
--spacing-16: 64px; /* セクション */
--spacing-20: 80px; /* ヒーロー */
```

### セクション用スペーシング
```css
--spacing-section-padding: 64px;        /* デスクトップ */
--spacing-section-padding-mobile: 48px; /* モバイル */
```

## コンポーネント

### セクション
```html
<section class="section" data-section="section-id">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">セクションタイトル</h2>
      <p class="section__subtitle">サブタイトル</p>
    </div>
    <!-- セクションコンテンツ -->
  </div>
</section>
```

### カードシステム
```html
<!-- 画像カード -->
<a href="#" class="image-card">
  <div class="image-card__media">
    <img src="..." alt="..." class="image-card__image">
  </div>
  <div class="image-card__content">
    <h3 class="image-card__title">タイトル</h3>
    <p class="image-card__description">説明</p>
  </div>
</a>

<!-- フィーチャードカード -->
<a href="#" class="featured-card">
  <div class="featured-card__media">
    <img src="..." alt="..." class="featured-card__image">
  </div>
  <div class="featured-card__content">
    <h3 class="featured-card__title">タイトル</h3>
    <p class="featured-card__description">説明</p>
  </div>
</a>

<!-- セレクションカード -->
<a href="#" class="selection-card">
  <div class="selection-card__icon">
    <svg class="selection-card__icon-svg">...</svg>
  </div>
  <div class="selection-card__content">
    <h3 class="selection-card__title">タイトル</h3>
    <p class="selection-card__description">説明</p>
  </div>
</a>
```

### カードグリッド
```html
<div class="cards-grid cards-grid--3">
  <!-- カードアイテム -->
</div>
```

### 下層ページヒーロー
```html
<section class="hero hero--subpage hero--features">
  <div class="container">
    <div class="hero__content">
      <h1 class="hero__title">ページタイトル</h1>
      <p class="hero__subtitle">サブタイトル</p>
      <p class="hero__description">説明文</p>
    </div>
    <div class="hero__accent"></div>
  </div>
</section>
```

## CSS命名規則

### BEM記法
```css
.block__element--modifier
```

### コンポーネント別プレフィックス
- `.hero--*` - ヒーローセクション
- `.section--*` - 一般セクション
- `.card--*` - カードコンポーネント
- `.nav--*` - ナビゲーション
- `.footer--*` - フッター

## ユーティリティクラス

### テキスト
```css
.text-center, .text-left, .text-right
.font-bold, .font-semibold, .font-medium, .font-regular
.text-primary, .text-secondary, .text-accent, .text-neutral, .text-white
```

### 背景
```css
.bg-primary, .bg-secondary, .bg-accent, .bg-neutral, .bg-white
```

### スペーシング
```css
.m-0, .m-1, .m-2, .m-3, .m-4, .m-6, .m-8
.p-0, .p-1, .p-2, .p-3, .p-4, .p-6, .p-8
```

## レスポンシブブレークポイント

```css
--breakpoint-sm: 640px;   /* スマートフォン */
--breakpoint-md: 768px;   /* タブレット */
--breakpoint-lg: 1024px;  /* デスクトップ */
--breakpoint-xl: 1280px;  /* 大デスクトップ */
```

## アニメーション

```css
--animation-duration-fast: 0.15s;
--animation-duration-base: 0.3s;
--animation-duration-slow: 0.5s;
--animation-easing-ease: cubic-bezier(0.4, 0, 0.2, 1);
```

## エレベーション（シャドウ）

```css
--elevation-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
--elevation-base: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
--elevation-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
--elevation-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
```

## 重要な制約

1. **直書き禁止** - 色・サイズ・スペーシングは必ずCSS変数を使用
2. **コンポーネント優先** - 既存コンポーネントを再利用
3. **レスポンシブ必須** - 768px/1024pxで崩れないこと
4. **アクセシビリティ** - alt属性・aria属性・見出し階層を適切に
5. **画像最適化** - webp優先・必要なら2x対応
