# 下層ページ用ヘローデザインシステム

## 概要

下層ページ用の専用ヘローデザインシステムです。トップページとは異なる、コンパクトで洗練されたデジタル調のデザインを提供します。

## 特徴

- **コンパクトなレイアウト**: トップページのフルワイドビューとは異なり、適切な高さのファーストビュー
- **デジタル調デザイン**: グラデーション、グリッドパターン、幾何学的なアクセント要素
- **カテゴリ別カラーリング**: 各セクションに応じた色分け
- **レスポンシブ対応**: モバイル・タブレット・デスクトップに対応
- **アニメーション効果**: フェードイン・スケールアニメーション

## 使用方法

### 1. CSSファイルの読み込み

```html
<link rel="stylesheet" href="../../css/subpage-hero.css">
```

### 2. HTML構造

```html
<section class="hero hero--subpage hero--[カテゴリ]" data-section="hero">
    <div class="container">
        <div class="hero__content">
            <h1 class="hero__title">ページタイトル</h1>
            <p class="hero__subtitle">サブタイトル</p>
            <p class="hero__description">ページの説明文</p>
        </div>
        
        <!-- デジタル調のアクセント要素 -->
        <div class="hero__accent"></div>
    </div>
</section>
```

### 3. カテゴリ別クラス

| カテゴリ | クラス名 | 説明 |
|---------|----------|------|
| 特徴 | `hero--features` | プライマリカラー系のグラデーション |
| 働き方 | `hero--workstyle` | セカンダリカラー系のグラデーション |
| 選考 | `hero--selection` | アクセントカラー系のグラデーション |
| 会社紹介 | `hero--company` | ニュートラルカラー系のグラデーション |

## デザイン要素

### 背景デザイン
- **グラデーション**: カテゴリ別の色調
- **幾何学パターン**: ラジアルグラデーションとリニアグラデーションの組み合わせ
- **グリッドパターン**: 微細なグリッドオーバーレイ

### タイポグラフィ
- **タイトル**: 大きく、太字、アンダーライン付き
- **サブタイトル**: 小文字、装飾線付き
- **説明文**: 読みやすいサイズと行間

### アクセント要素
- **円形のアクセント**: 右上に配置された装飾要素
- **アニメーション**: フェードイン・スケール効果

## レスポンシブ対応

### デスクトップ (1024px以上)
- フルサイズのタイトルと装飾要素
- 左右に配置された装飾線

### タブレット (768px - 1023px)
- 中サイズのタイトル
- 装飾線の非表示

### モバイル (767px以下)
- コンパクトなタイトル
- 最小限の装飾要素

## カスタマイズ

### カスタムカラー
新しいカテゴリの色を追加する場合：

```css
.hero--custom {
  background: linear-gradient(135deg, 
    var(--color-custom-50) 0%, 
    var(--color-custom-100) 100%);
}

.hero--custom::before {
  background-image: 
    radial-gradient(circle at 25% 25%, var(--color-custom-200) 0%, transparent 40%),
    radial-gradient(circle at 75% 75%, var(--color-custom-300) 0%, transparent 40%);
}
```

### アニメーション調整
アニメーションの速度や遅延を調整：

```css
.hero--subpage .hero__content {
  animation: fadeInUp 1.2s ease-out; /* 速度調整 */
}

.hero--subpage .hero__accent {
  animation: fadeInScale 1.5s ease-out 0.5s both; /* 遅延調整 */
}
```

## アクセシビリティ

- **セマンティックHTML**: 適切な見出し構造
- **コントラスト**: WCAG準拠の色のコントラスト比
- **フォーカス**: キーボードナビゲーション対応
- **スクリーンリーダー**: 適切なARIA属性

## ブラウザサポート

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## 今後の拡張予定

- ダークモード対応の強化
- 追加のアニメーション効果
- カスタムアクセント要素のテンプレート
- インタラクティブ要素の追加
