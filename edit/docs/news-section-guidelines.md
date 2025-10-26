# お知らせセクションガイドライン

## 概要
デジタル庁デザインシステムに準拠したお知らせセクションの実装ガイドラインです。WordPressのお知らせ投稿を反映できる構造になっています。

## デザインシステム準拠

### 参考資料
- [デジタル庁デザインシステム](https://www.figma.com/design/BgKRTIJlpHTRmj9xijc52X/%E3%83%87%E3%82%B8%E3%82%BF%E3%83%AB%E5%BA%81%E3%83%87%E3%82%B6%E3%82%A4%E3%83%B3%E3%82%B7%E3%82%B9%E3%83%86%E3%83%A0-%E3%83%87%E3%82%B6%E3%82%A4%E3%83%B3%E3%83%87%E3%83%BC%E3%82%BF-v2.8.0--Community-?node-id=12692-1443&m=dev&t=amCwYDphWQeND3mh-1)

### カラーパレット
- **背景色**: `var(--color-neutral-50)` - セクション背景
- **カード背景**: `var(--color-neutral-white)` - お知らせアイテム背景
- **ボーダー**: `var(--color-neutral-200)` - デフォルトボーダー
- **ホバー時**: `var(--color-primary-300)` - ホバー時のボーダー
- **テキスト**: `var(--color-neutral-900)` - メインテキスト
- **サブテキスト**: `var(--color-neutral-700)` - 抜粋文

### バッジカラー
- **重要**: `var(--color-danger-100)` / `var(--color-danger-700)`
- **イベント**: `var(--color-secondary-100)` / `var(--color-secondary-700)`
- **採用**: `var(--color-primary-100)` / `var(--color-primary-700)`

## HTML構造

### セクション構造
```html
<section class="news" data-section="news" id="news">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">お知らせ</h2>
      <p class="section__subtitle">News</p>
    </div>
    <div class="news__list">
      <!-- お知らせアイテム -->
    </div>
    <div class="news__footer">
      <a href="/news/" class="btn btn--outline">すべてのお知らせを見る</a>
    </div>
  </div>
</section>
```

### お知らせアイテム構造
```html
<article class="news__item">
  <div class="news__date">
    <time datetime="2024-01-15">2024.01.15</time>
  </div>
  <div class="news__content">
    <h3 class="news__title">
      <a href="/news/2024/01/15/recruitment-start/" class="news__link">
        2024年度新卒採用を開始いたします
      </a>
    </h3>
    <p class="news__excerpt">テンファイブでは、2024年度新卒採用を開始いたします。</p>
  </div>
  <div class="news__badge news__badge--important">重要</div>
</article>
```

## CSSクラス

### メインクラス
- `.news` - お知らせセクション
- `.news__list` - お知らせリストコンテナ
- `.news__item` - 個別のお知らせアイテム
- `.news__date` - 日付エリア
- `.news__content` - コンテンツエリア
- `.news__title` - タイトル
- `.news__link` - タイトルリンク
- `.news__excerpt` - 抜粋文
- `.news__badge` - バッジ
- `.news__footer` - フッター

### バッジバリエーション
- `.news__badge--important` - 重要なお知らせ
- `.news__badge--event` - イベント関連
- `.news__badge--recruitment` - 採用関連

## レスポンシブ対応

### デスクトップ（1025px以上）
- 横並びレイアウト（日付、コンテンツ、バッジ）
- ホバーエフェクト（ボーダー色変更、影、上移動）

### タブレット（769px - 1024px）
- 縦積みレイアウト
- 日付の左寄せ
- フォントサイズの調整

### モバイル（768px以下）
- コンパクトなレイアウト
- パディングの縮小
- フォントサイズの最適化

## アクセシビリティ

### キーボードナビゲーション
- フォーカス時のアウトライン表示
- タブ順序の適切な設定

### スクリーンリーダー対応
- セマンティックHTML（`<article>`, `<time>`）
- 適切な`aria-label`の設定
- `datetime`属性の使用

### 視覚的配慮
- 高コントラストモード対応
- 動きの軽減設定対応
- 十分なコントラスト比の確保

## WordPress連携

### 投稿データの反映
```php
// WordPressのお知らせ投稿を取得
$news_posts = get_posts(array(
  'post_type' => 'news',
  'posts_per_page' => 3,
  'post_status' => 'publish'
));

foreach ($news_posts as $post) {
  // お知らせアイテムのHTMLを生成
}
```

### カスタムフィールド
- `news_badge` - バッジの種類（important, event, recruitment）
- `news_excerpt` - 抜粋文（投稿の抜粋とは別）

## デザインシステムトークン

### スペーシング
```json
{
  "news-item-padding": {
    "value": "16px",
    "type": "spacing",
    "description": "お知らせアイテムのパディング"
  },
  "news-item-gap": {
    "value": "12px",
    "type": "spacing",
    "description": "お知らせアイテム間の間隔"
  }
}
```

### CSS変数
```css
--spacing-news-item-padding: 16px;
--spacing-news-item-gap: 12px;
```

## ベストプラクティス

### コンテンツ
1. **タイトル**: 簡潔で分かりやすいタイトル
2. **抜粋文**: 50文字以内で要点をまとめる
3. **日付**: ISO形式（YYYY-MM-DD）で記録
4. **バッジ**: 適切なカテゴリ分類

### デザイン
1. **一貫性**: デザインシステムトークンの使用
2. **視認性**: 十分なコントラスト比の確保
3. **操作性**: 適切なタッチターゲットサイズ
4. **レスポンシブ**: 全デバイスでの最適表示

### パフォーマンス
1. **軽量化**: 必要最小限のCSS
2. **最適化**: 画像の適切な圧縮
3. **キャッシュ**: 静的コンテンツのキャッシュ活用

## 今後の拡張

### 機能追加
- カテゴリフィルタリング
- 検索機能
- ページネーション
- RSS配信

### デザイン改善
- アニメーション効果
- ダークモード対応
- 印刷用スタイル
- 多言語対応
