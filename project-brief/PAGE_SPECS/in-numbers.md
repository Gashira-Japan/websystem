# In Numbers（採用実績）ページ仕様

## 目的
テンファイブの採用実績・数値を視覚的に伝えるページ

## テンプレート
- **ベース**: `templates/page-template.html`
- **ヒーロー**: `templates/subpage-hero-template.html`
- **コンポーネント**: Section, StatCard, CTA

## セクション構成

### 1. ヒーローセクション
```html
<section class="hero hero--subpage hero--features">
  <div class="container">
    <div class="hero__content">
      <h1 class="hero__title">数字で見るテンファイブ</h1>
      <p class="hero__subtitle">In Numbers</p>
      <p class="hero__description">テンファイブの成長と実績を数字でご紹介します</p>
    </div>
    <div class="hero__accent"></div>
  </div>
</section>
```

### 2. 統計グリッドセクション
```html
<section class="section" data-section="stats">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">採用実績</h2>
      <p class="section__subtitle">Recruitment Results</p>
    </div>
    <div class="cards-grid cards-grid--3">
      <!-- StatCard × 6 -->
    </div>
  </div>
</section>
```

### 3. CTAセクション
```html
<section class="section" data-section="cta">
  <div class="container">
    <div class="cta">
      <h2 class="cta__title">一緒に成長しませんか？</h2>
      <p class="cta__description">テンファイブで新しいキャリアを始めましょう</p>
      <div class="cta__actions">
        <a href="../pages/selection/new-grad/" class="btn btn--primary">新卒採用を見る</a>
        <a href="../pages/selection/mid-career/" class="btn btn--outline">キャリア採用を見る</a>
      </div>
    </div>
  </div>
</section>
```

## コンポーネント仕様

### StatCard（統計カード）
```html
<div class="stat-card">
  <div class="stat-card__number">150+</div>
  <div class="stat-card__label">プロジェクト数</div>
  <div class="stat-card__description">累計実績</div>
</div>
```

### 使用する統計データ
1. **プロジェクト数**: 150+
2. **クライアント数**: 50+
3. **従業員数**: 30+
4. **設立年数**: 5年
5. **成長率**: 200%
6. **満足度**: 95%

## 文言ソース
- **データソース**: `ascii-md/01_in-numbers_ascii.md`
- **画像**: `assets/images/numbers.png`
- **ロゴ**: `assets/images/recruit-logo.svg`

## 完了条件

### デザイン
- [ ] デザイントークンのみ使用（直書き禁止）
- [ ] 768px/1024pxで崩れない
- [ ] 統計カードが3列グリッドで表示
- [ ] ヒーローセクションが適切に表示

### アクセシビリティ
- [ ] Lighthouse (Accessibility) 90+ 目安
- [ ] alt属性が適切に設定
- [ ] 見出し階層が正しい
- [ ] キーボードナビゲーション対応

### パフォーマンス
- [ ] 画像はwebp優先
- [ ] 必要なら2x対応
- [ ] 読み込み速度最適化

### コード品質
- [ ] 既存コンポーネントを再利用
- [ ] 独自CSSは`components/_local-in-numbers.scss`に限定
- [ ] セマンティックHTML使用
- [ ] 適切なaria属性設定
