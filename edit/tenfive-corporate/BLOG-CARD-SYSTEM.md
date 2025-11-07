# ブログカードシステム - デザインガイド

## 🎨 概要

デジタル庁のデザインシステムを参考に、より美しく使いやすいブログ記事紹介用のカードコンポーネントを実装しました。

## 📋 特徴

### 1. **デジタル庁デザインシステム準拠**
- カードコンポーネントのガイドラインに従った設計
- イメージエリア、メインエリア、サブエリアの適切な配置
- アクセシビリティとユーザビリティを重視

### 2. **豊富な情報表示**
- **アイキャッチ画像**: 視覚的な魅力とコンテキストの提供
- **カテゴリバッジ**: 色分けされたカテゴリ表示
- **メタ情報**: 日付、読了時間、著者情報
- **タグシステム**: 関連キーワードの表示
- **説明文**: 記事の概要を簡潔に表示

### 3. **インタラクティブな体験**
- ホバー効果とスムーズなアニメーション
- 画像のズーム効果
- カードの浮き上がり効果
- 読み進めるための明確なCTA

## 🏗️ カード構造

```
┌─────────────────────────────────┐
│ イメージエリア                  │
│ ┌─────────────────────────────┐ │
│ │ [カテゴリバッジ] [画像]      │ │
│ └─────────────────────────────┘ │
├─────────────────────────────────┤
│ メインエリア                    │
│ [日付] [読了時間]               │
│ タイトル                        │
│ 説明文                          │
│ [タグ] [タグ] [タグ]            │
├─────────────────────────────────┤
│ サブエリア                      │
│ [著者] [続きを読む]             │
└─────────────────────────────────┘
```

## 🎯 カードバリエーション

### 1. **標準カード**
```html
<article class="blog-card">
  <!-- 標準的なブログ記事カード -->
</article>
```

### 2. **フィーチャーカード**
```html
<article class="blog-card blog-card--featured">
  <!-- 大きめの注目記事カード -->
</article>
```

### 3. **コンパクトカード**
```html
<article class="blog-card blog-card--compact">
  <!-- 小さめのカード -->
</article>
```

### 4. **ホリゾンタルカード**
```html
<article class="blog-card blog-card--horizontal">
  <!-- 横長レイアウトのカード -->
</article>
```

## 🏷️ カテゴリバッジ

| カテゴリ | クラス | 色 | 用途 |
|----------|--------|----|----- |
| 技術 | `blog-card__category-badge--tech` | プライマリブルー | 技術記事 |
| キャリア | `blog-card__category-badge--career` | アクセントグリーン | キャリア関連 |
| 実績 | `blog-card__category-badge--case` | セカンダリグレー | 案件実績 |
| カリキュラム | `blog-card__category-badge--curriculum` | インフォブルー | 学習プログラム |

## 📱 レスポンシブ対応

### デスクトップ（1024px以上）
- 3カラムグリッドレイアウト
- フィーチャーカードは2カラム分使用

### タブレット（768px-1023px）
- 2カラムグリッドレイアウト
- ホリゾンタルカードは縦レイアウトに変更

### モバイル（767px以下）
- 1カラムレイアウト
- 画像サイズの最適化
- タッチ操作に適したサイズ

## 🎨 デザイン要素

### カラーシステム
- **プライマリ**: `var(--color-primary-600)` - メインアクション
- **セカンダリ**: `var(--color-secondary-600)` - サブ要素
- **アクセント**: `var(--color-accent-600)` - 注目要素
- **ニュートラル**: `var(--color-neutral-*)` - テキスト・背景

### スペーシング
- **カード間隔**: `var(--spacing-6)` (24px)
- **内部パディング**: `var(--spacing-6)` (24px)
- **画像高さ**: 200px (標準), 240px (フィーチャー), 160px (コンパクト)

### タイポグラフィ
- **タイトル**: `var(--font-size-lg)` (18px), `font-weight-semibold`
- **説明文**: `var(--font-size-sm)` (14px), `line-height-relaxed`
- **メタ情報**: `var(--font-size-sm)` (14px), `font-weight-medium`

## 🚀 使用方法

### 1. 基本的なカード
```html
<article class="blog-card">
  <a href="/article/" class="blog-card__link">
    <div class="blog-card__image-area">
      <img src="image.jpg" alt="記事のイメージ" class="blog-card__image">
      <div class="blog-card__image-overlay"></div>
      <span class="blog-card__category-badge blog-card__category-badge--tech">技術</span>
    </div>
    <div class="blog-card__main-area">
      <div class="blog-card__meta">
        <time class="blog-card__date" datetime="2024-01-15">2024.01.15</time>
        <span class="blog-card__reading-time">5分</span>
      </div>
      <h3 class="blog-card__title">記事タイトル</h3>
      <p class="blog-card__description">記事の説明文</p>
      <div class="blog-card__tags">
        <span class="blog-card__tag">タグ1</span>
        <span class="blog-card__tag">タグ2</span>
      </div>
    </div>
    <div class="blog-card__footer">
      <div class="blog-card__author">
        <div class="blog-card__author-avatar">A</div>
        <span>著者名</span>
      </div>
      <span class="blog-card__read-more">続きを読む</span>
    </div>
  </a>
</article>
```

### 2. コンテナの設定
```html
<div class="blog-card-container">
  <!-- カード群 -->
</div>
```

## 📊 適用セクション

### 1. **テックブログ**
- 技術記事の紹介
- フィーチャーカードで注目記事を強調
- 技術タグで分類

### 2. **実績紹介**
- 案件実績の紹介
- 実績画像と詳細説明
- 技術スタックのタグ表示

### 3. **カリキュラム**
- 学習プログラムの紹介
- 受講時間の表示
- 講師情報の表示

## 🔧 カスタマイズ

### カテゴリバッジの色変更
```css
.blog-card__category-badge--custom {
  background-color: #your-color;
  color: white;
}
```

### カードサイズの調整
```css
.blog-card--custom {
  /* カスタムサイズの設定 */
}
```

## ♿ アクセシビリティ

- **キーボードナビゲーション**: 完全対応
- **スクリーンリーダー**: 適切なラベルとARIA属性
- **カラーコントラスト**: WCAG AA準拠
- **フォーカス表示**: 明確な視覚的フィードバック

## 📈 パフォーマンス

- **画像最適化**: 遅延読み込み対応
- **CSS最適化**: 効率的なセレクタ使用
- **アニメーション**: GPU加速の活用
- **レスポンシブ画像**: 適切なサイズの提供

---

**最終更新**: 2025-01-27  
**バージョン**: 1.0.0  
**参考**: [デジタル庁デザインシステム](https://design.digital.go.jp/)
