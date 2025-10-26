# 下層ページ開発ガイド

## 開発フロー

### 1. ページ作成手順

1. **テンプレートのコピー**
   ```bash
   cp templates/page-template.html pages/[カテゴリ]/[ページ名]/index.html
   ```

2. **テンプレート変数の置換**
   - `{{PAGE_TITLE}}` → ページタイトル
   - `{{PAGE_DESCRIPTION}}` → ページの説明
   - `{{BREADCRUMB_ITEMS}}` → パンくずリスト
   - `{{PAGE_CONTENT}}` → ページコンテンツ

3. **セクションの追加**
   - `templates/section-template.html` を参考にセクションを作成
   - デザインシステムのクラスを使用

### 2. デザインシステムの活用

#### カラーパレット
```css
/* プライマリカラー */
--color-primary-500: #228dc4;
--color-primary-600: #0d679e;

/* セカンダリカラー */
--color-secondary-500: #90b425;
--color-secondary-600: #138f8f;

/* アクセントカラー */
--color-accent-500: #e6951e;
```

#### スペーシング（8pxベース）
```css
--spacing-2: 8px;
--spacing-4: 16px;
--spacing-6: 24px;
--spacing-8: 32px;
--spacing-12: 48px;
--spacing-16: 64px;
```

#### タイポグラフィ
```css
/* 見出し */
.heading-1 { font-size: var(--font-size-6xl); }
.heading-2 { font-size: var(--font-size-5xl); }
.heading-3 { font-size: var(--font-size-4xl); }

/* 本文 */
.body-large { font-size: var(--font-size-lg); }
.body-regular { font-size: var(--font-size-base); }
.body-small { font-size: var(--font-size-sm); }
```

### 3. コンポーネントの使用

#### カードコンポーネント
```html
<a href="/path" class="image-card">
    <div class="image-card__media">
        <img src="image.jpg" alt="説明" class="image-card__image">
    </div>
    <div class="image-card__content">
        <h3 class="image-card__title">タイトル</h3>
        <p class="image-card__description">説明文</p>
    </div>
</a>
```

#### ボタンコンポーネント
```html
<a href="/path" class="btn btn--primary btn--large">ボタンテキスト</a>
<button class="btn btn--outline btn--small">ボタンテキスト</button>
```

#### セクション構造
```html
<section class="section-name" data-section="section-id" id="section-id">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title">セクションタイトル</h2>
            <p class="section__subtitle">サブタイトル</p>
        </div>
        <div class="section__content">
            <!-- コンテンツ -->
        </div>
    </div>
</section>
```

### 4. レスポンシブ対応

#### ブレークポイント
```css
/* モバイル */
@media (max-width: 768px) { }

/* タブレット */
@media (min-width: 769px) and (max-width: 1024px) { }

/* デスクトップ */
@media (min-width: 1025px) { }
```

#### グリッドシステム
```html
<!-- 2列グリッド -->
<div class="cards-grid cards-grid--2">
    <!-- カードアイテム -->
</div>

<!-- 3列グリッド -->
<div class="cards-grid cards-grid--3">
    <!-- カードアイテム -->
</div>
```

### 5. アクセシビリティ

#### 必須要素
- `alt` 属性の設定
- `aria-label` の適切な使用
- キーボードナビゲーション対応
- コントラスト比の確保

#### セマンティックHTML
```html
<main>
    <section>
        <h2>セクションタイトル</h2>
        <article>
            <h3>記事タイトル</h3>
            <p>記事内容</p>
        </article>
    </section>
</main>
```

### 6. パフォーマンス

#### 画像最適化
- WebP形式の使用
- 適切なサイズの画像
- 遅延読み込みの実装

#### CSS最適化
- デザインシステムの変数使用
- 不要なスタイルの削除
- メディアクエリの効率的な使用

### 7. テスト項目

#### 機能テスト
- [ ] リンクの動作確認
- [ ] フォームの送信確認
- [ ] モーダルの開閉確認
- [ ] タブの切り替え確認

#### レスポンシブテスト
- [ ] モバイル表示確認
- [ ] タブレット表示確認
- [ ] デスクトップ表示確認

#### アクセシビリティテスト
- [ ] キーボードナビゲーション
- [ ] スクリーンリーダー対応
- [ ] コントラスト比確認

### 8. ファイル命名規則

#### ディレクトリ構造
```
pages/
├── features/
│   ├── in-numbers/
│   │   └── index.html
│   └── industry-analysis/
│       └── index.html
├── workstyle/
│   ├── career-path/
│   │   └── index.html
│   └── schedule/
│       └── index.html
```

#### ファイル名
- 小文字とハイフンを使用
- 日本語は避ける
- 意味のある名前を付ける

### 9. 開発時の注意点

#### デザインシステム準拠
- 既存のCSS変数を使用
- 新しいスタイルは最小限に
- コンポーネントの再利用を心がける

#### コード品質
- インデントの統一
- コメントの適切な記述
- 不要なコードの削除

#### ブラウザ対応
- Chrome（最新版）
- Firefox（最新版）
- Safari（最新版）
- Edge（最新版）
