# 統一ニュースシステム - 設計仕様書

## 🎯 概要

テンファイブのコーポレートサイトと採用サイトで統一されたニュースシステムを実装し、WordPress移行時にも対応できる設計にしました。

## 📋 特徴

### 1. **サイト間統一**
- コーポレートサイトと採用サイトで同一のデザイン
- 統一されたHTML構造とCSSクラス
- 一貫したユーザー体験

### 2. **WordPress対応**
- WordPress用のPHP関数テンプレート提供
- カスタムフィールドとメタボックス対応
- ショートコードとREST API対応

### 3. **拡張性**
- カテゴリ別のバッジシステム
- 柔軟な表示オプション
- レスポンシブ対応

## 🏗️ ファイル構成

```
DesignSystem/
├── shared-news-system.css              # 統一ニュースCSS
├── wordpress-news-functions.php        # WordPress用関数
├── SHARED-NEWS-SYSTEM.md              # このドキュメント
├── tenfive-recruit-clean/
│   └── index.html                     # 採用サイト（統一CSS使用）
└── tenfive-corporate/
    └── index.html                     # コーポレートサイト（統一CSS使用）
```

## 📐 HTML構造

### 基本構造
```html
<section class="news" data-section="news" id="news">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title">お知らせ</h2>
            <p class="section__subtitle">News</p>
        </div>
        <div class="news__list">
            <article class="news__item">
                <div class="news__meta-row">
                    <div class="news__date">
                        <time datetime="2024-01-15">2024.01.15</time>
                    </div>
                    <div class="news__badge news__badge--important">重要</div>
                </div>
                <div class="news__content">
                    <h3 class="news__title">
                        <a href="/news/example/" class="news__link">記事タイトル</a>
                    </h3>
                    <p class="news__excerpt">記事の抜粋文</p>
                </div>
            </article>
            <hr class="news__divider">
        </div>
        <div class="news__footer">
            <a href="/news/" class="link-text">すべてのお知らせを見る</a>
        </div>
    </div>
</section>
```

### WordPress用構造（追加要素）
```html
<article class="news__item wp-post">
    <!-- 基本構造 + 以下の追加要素 -->
    <div class="news__meta">
        <span class="news__author">著者名</span>
        <div class="news__categories">
            <a href="/category/example/" class="news__category-link">カテゴリ</a>
        </div>
    </div>
</article>
```

## 🏷️ バッジシステム

| バッジ | クラス | 色 | 用途 |
|--------|--------|----|----- |
| 重要 | `news__badge--important` | 赤 | 重要な告知 |
| お知らせ | `news__badge--notice` | オレンジ | 一般的なお知らせ |
| 更新 | `news__badge--update` | 青 | コンテンツ更新 |
| イベント | `news__badge--event` | 青 | イベント告知 |
| 採用 | `news__badge--recruitment` | グリーン | 採用関連 |
| コーポレート | `news__badge--corporate` | グレー | コーポレート関連 |

## 🎨 CSS設計

### デザインシステム準拠
- 統一されたスペーシング（8pxベース）
- 統一されたカラーパレット
- 統一されたタイポグラフィ
- 統一されたアニメーション

### レスポンシブ対応
- **デスクトップ**: 横並びレイアウト（日付・バッジ・コンテンツ）
- **タブレット**: 横並びレイアウト維持、gap調整
- **モバイル**: 横並びレイアウト維持、サイズ最適化

## 🔧 WordPress実装

### 1. 関数の使用
```php
// 基本的な使用
echo tenfive_display_news_list();

// カスタムオプション
echo tenfive_display_news_list([
    'posts_per_page' => 10,
    'show_excerpt' => true,
    'show_author' => true,
    'badge_field' => 'news_type'
]);
```

### 2. ショートコード
```php
// 投稿や固定ページで使用
[tenfive_news posts_per_page="5" category="news" show_excerpt="true"]
```

### 3. REST API
```javascript
// JavaScriptで使用
fetch('/wp-json/tenfive/v1/news?posts_per_page=5')
    .then(response => response.json())
    .then(data => console.log(data));
```

### 4. カスタムフィールド
WordPress管理画面で「ニュースタイプ」メタボックスが自動的に追加されます。

## 📱 レスポンシブ仕様

### デスクトップ（768px以上）
```css
.news__meta-row {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
}
```

### タブレット（481px-767px）
```css
.news__meta-row {
    gap: var(--spacing-2);
}
```

### モバイル（480px以下）
```css
.news__meta-row {
    gap: var(--spacing-1);
    flex-wrap: wrap;
}
```

## ♿ アクセシビリティ

- **キーボードナビゲーション**: 完全対応
- **スクリーンリーダー**: 適切なセマンティックマークアップ
- **フォーカス表示**: 明確な視覚的フィードバック
- **カラーコントラスト**: WCAG AA準拠

## 🚀 使用方法

### 1. 静的サイトでの使用
```html
<!-- CSSファイルを読み込み -->
<link rel="stylesheet" href="../shared-news-system.css">

<!-- HTML構造をコピーして使用 -->
<section class="news">
    <!-- ニュースコンテンツ -->
</section>
```

### 2. WordPressでの使用
```php
// functions.phpに追加
require_once 'wordpress-news-functions.php';

// テンプレートで使用
<?php echo tenfive_display_news_list(); ?>
```

### 3. カスタマイズ
```css
/* カスタムバッジ */
.news__badge--custom {
    background-color: #your-color;
    color: white;
}

/* カスタムレイアウト */
.news__item--custom {
    /* カスタムスタイル */
}
```

## 📊 パフォーマンス

- **CSS最適化**: 効率的なセレクタ使用
- **アニメーション**: GPU加速の活用
- **画像最適化**: 遅延読み込み対応（将来実装）

## 🔄 メンテナンス

### 更新手順
1. `shared-news-system.css`を更新
2. 全サイトでCSSファイルを同期
3. WordPress関数ファイルも同期
4. ビジュアルテストを実行

### バージョン管理
- CSSファイル: セマンティックバージョニング
- WordPress関数: 互換性を考慮した更新

## 📈 今後の拡張予定

### 1. **機能拡張**
- 画像サポート
- ソート機能
- フィルタリング機能
- ページネーション

### 2. **WordPress拡張**
- カスタム投稿タイプ対応
- Gutenbergブロック対応
- 多言語対応

### 3. **パフォーマンス向上**
- 遅延読み込み
- キャッシュ最適化
- CDN対応

## 🛠️ トラブルシューティング

### よくある問題

#### 1. スタイルが適用されない
```html
<!-- CSSファイルのパスを確認 -->
<link rel="stylesheet" href="../shared-news-system.css">
```

#### 2. WordPressで表示されない
```php
// 関数ファイルが正しく読み込まれているか確認
require_once 'wordpress-news-functions.php';
```

#### 3. レスポンシブが効かない
```css
/* ビューポートメタタグを確認 */
<meta name="viewport" content="width=device-width, initial-scale=1.0">
```

---

**最終更新**: 2025-01-27  
**バージョン**: 1.0.0  
**対象**: コーポレートサイト・採用サイト・WordPress
