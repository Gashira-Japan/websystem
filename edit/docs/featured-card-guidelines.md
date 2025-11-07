# フィーチャードカードシステムガイドライン

## 概要
デジタル庁デザインシステムに準拠した、目立つクリック可能なカードコンポーネントの実装ガイドラインです。重要なコンテンツを強調表示するために使用されます。

## デザインシステム準拠

### 参考資料
- [デジタル庁デザインシステム](https://www.figma.com/design/BgKRTIJlpHTRmj9xijc52X/%E3%83%87%E3%82%B8%E3%82%BF%E3%83%AB%E5%BA%81%E3%83%87%E3%82%B6%E3%82%A4%E3%83%B3%E3%82%B7%E3%82%B9%E3%83%86%E3%83%A0-%E3%83%87%E3%82%B6%E3%82%A4%E3%83%B3%E3%83%87%E3%83%BC%E3%82%BF-v2.8.0--Community-?node-id=11360-29149&m=dev&t=amCwYDphWQeND3mh-1)

### カラーパレット
- **背景色**: `var(--color-neutral-white)` - カード背景
- **ボーダー**: `var(--color-primary-200)` - デフォルトボーダー
- **ホバー時**: `var(--color-primary-400)` - ホバー時のボーダー
- **メディア背景**: `linear-gradient(135deg, var(--color-primary-50), var(--color-primary-50))`
- **テキスト**: `var(--color-neutral-900)` - メインテキスト
- **サブテキスト**: `var(--color-primary-600)` - サブタイトル

### バッジカラー
- **重要**: `var(--color-danger-500)` - 重要なお知らせ用

## HTML構造

### 基本構造
```html
<a href="/ideal-candidate/" class="featured-card featured-card--profile" aria-label="求める人物像の詳細ページへ">
  <div class="featured-card__media">
    <div class="featured-card__image-placeholder">
      <svg class="featured-card__illustration" viewBox="0 0 200 120" fill="none">
        <!-- カスタムイラストレーション -->
      </svg>
    </div>
    <div class="featured-card__badge">
      <span class="featured-card__badge-text">重要</span>
    </div>
  </div>
  <div class="featured-card__content">
    <div class="featured-card__header">
      <h3 class="featured-card__title">求める人物像</h3>
      <p class="featured-card__subtitle">Ideal Candidate Profile</p>
    </div>
    <p class="featured-card__description">新卒・中途・共通して求める人物像をご紹介。</p>
    <div class="featured-card__cta">
      <span class="featured-card__cta-text">詳細を見る</span>
      <svg class="featured-card__cta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M5 12h14M12 5l7 7-7 7"/>
      </svg>
    </div>
  </div>
</a>
```

## CSSクラス

### メインクラス
- `.featured-card` - フィーチャードカード
- `.featured-card--profile` - プロファイル専用スタイル
- `.featured-card__media` - メディアエリア
- `.featured-card__image-placeholder` - 画像プレースホルダー
- `.featured-card__illustration` - イラストレーション
- `.featured-card__badge` - バッジ
- `.featured-card__badge-text` - バッジテキスト
- `.featured-card__content` - コンテンツエリア
- `.featured-card__header` - ヘッダー
- `.featured-card__title` - タイトル
- `.featured-card__subtitle` - サブタイトル
- `.featured-card__description` - 説明文
- `.featured-card__cta` - コールトゥアクション
- `.featured-card__cta-text` - CTAテキスト
- `.featured-card__cta-icon` - CTAアイコン

## デザイン特徴

### 視覚的インパクト
1. **大きなメディアエリア**: 200pxの高さでイラストレーションを表示
2. **グラデーション背景**: プライマリーとセカンダリーカラーのグラデーション
3. **目立つボーダー**: 2pxの太いボーダーで存在感を演出
4. **ホバーエフェクト**: 上移動、影の強化、ボーダー色変更

### インタラクション
1. **ホバー効果**: 
   - `transform: translateY(-4px)` - 上に移動
   - `box-shadow: var(--elevation-3)` - 影を強化
   - `border-color: var(--color-primary-400)` - ボーダー色変更
2. **CTAアニメーション**: 矢印アイコンが右に移動
3. **フォーカス状態**: アウトライン表示

### コンテンツ構造
1. **階層化された情報**:
   - メインタイトル（日本語）
   - サブタイトル（英語）
   - 説明文
   - CTA（Call to Action）
2. **バッジ**: 重要度を示すバッジ
3. **イラストレーション**: カスタムSVGで視覚的インパクト

## レスポンシブ対応

### デスクトップ（1025px以上）
- フルサイズのメディアエリア（200px）
- 大きなタイトル（2xl）
- 十分なパディング（24px）

### タブレット（769px - 1024px）
- メディアエリアの縮小（160px）
- タイトルサイズの調整（xl）
- パディングの調整（16px）

### モバイル（768px以下）
- コンパクトなレイアウト（140px）
- 小さなタイトル（lg）
- 最小パディング（12px）

## アクセシビリティ

### キーボードナビゲーション
```css
.featured-card:focus {
  outline: 2px solid var(--color-primary-500);
  outline-offset: 2px;
}
```

### スクリーンリーダー対応
- セマンティックHTML（`<a>`タグ）
- 適切な`aria-label`の設定
- 構造化されたマークアップ

### 視覚的配慮
```css
/* 高コントラストモード対応 */
@media (prefers-contrast: high) {
  .featured-card {
    border-width: 3px;
  }
}

/* 動きの軽減設定対応 */
@media (prefers-reduced-motion: reduce) {
  .featured-card {
    transition: none;
  }
}
```

## デザインシステムトークン

### スペーシング
```json
{
  "featured-card-padding": {
    "value": "24px",
    "type": "spacing",
    "description": "フィーチャードカードのパディング"
  },
  "featured-card-media-height": {
    "value": "200px",
    "type": "spacing",
    "description": "フィーチャードカードメディアエリアの高さ"
  }
}
```

### CSS変数
```css
--spacing-featured-card-padding: 24px;
--spacing-featured-card-media-height: 200px;
```

## 使用例

### 求める人物像カード
```html
<a href="/ideal-candidate/" class="featured-card featured-card--profile">
  <!-- カスタムイラストレーション -->
  <!-- 重要バッジ -->
  <!-- タイトルと説明 -->
  <!-- CTA -->
</a>
```

### 他の用途での拡張
- 重要なイベント告知
- 新機能の紹介
- 特別なキャンペーン
- 重要なニュース

## ベストプラクティス

### デザイン
1. **視覚的階層**: 重要な情報を上位に配置
2. **一貫性**: デザインシステムトークンの使用
3. **バランス**: メディアとコンテンツの適切な比率
4. **アクセシビリティ**: 十分なコントラスト比の確保

### コンテンツ
1. **タイトル**: 簡潔で分かりやすい
2. **説明文**: 50文字以内で要点をまとめる
3. **CTA**: 明確な行動指示
4. **バッジ**: 適切な重要度の表示

### パフォーマンス
1. **軽量化**: SVGイラストレーションの使用
2. **最適化**: 必要最小限のCSS
3. **キャッシュ**: 静的コンテンツのキャッシュ活用

## 今後の拡張

### 機能追加
- アニメーション効果の強化
- インタラクティブな要素の追加
- 動的コンテンツの対応

### デザイン改善
- ダークモード対応
- 印刷用スタイル
- 多言語対応
- カスタムイラストレーションの追加
