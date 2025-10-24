# SES・SIer業界構造ページ仕様

## 目的
業界内でのポジションと独自の強みを分析し、競合他社との差別化ポイントを説明

## テンプレート
- **ベース**: `templates/page-template.html`
- **ヒーロー**: `templates/subpage-hero-template.html`
- **コンポーネント**: Section, ImageCard, CTA

## セクション構成

### 1. ヒーローセクション
```html
<section class="hero hero--subpage hero--features">
  <div class="container">
    <div class="hero__content">
      <h1 class="hero__title">SES・SIer業界構造から見た当社の強み</h1>
      <p class="hero__subtitle">Industry Analysis</p>
      <p class="hero__description">業界内でのポジションと独自の強みを分析。競合他社との差別化ポイントと、当社が持つ競争優位性をご説明します。</p>
    </div>
    <div class="hero__accent"></div>
  </div>
</section>
```

### 2. 業界分析セクション
```html
<section class="section" data-section="industry-analysis">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">業界構造分析</h2>
      <p class="section__subtitle">Industry Structure Analysis</p>
    </div>
    <div class="industry-chart">
      <img src="../assets/images/industry.png" alt="業界構造図" class="industry-chart__image">
    </div>
  </div>
</section>
```

### 3. 強みセクション
```html
<section class="section" data-section="strengths">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">当社の強み</h2>
      <p class="section__subtitle">Our Strengths</p>
    </div>
    <div class="cards-grid cards-grid--2">
      <!-- StrengthCard × 4 -->
    </div>
  </div>
</section>
```

## コンポーネント仕様

### StrengthCard（強みカード）
```html
<div class="strength-card">
  <div class="strength-card__icon">
    <svg class="strength-card__icon-svg">...</svg>
  </div>
  <div class="strength-card__content">
    <h3 class="strength-card__title">技術力</h3>
    <p class="strength-card__description">最新技術への対応力と実装経験</p>
  </div>
</div>
```

### 使用する強みデータ
1. **技術力**: 最新技術への対応力と実装経験
2. **柔軟性**: クライアントのニーズに応じた対応
3. **成長性**: 継続的なスキルアップとキャリア形成
4. **安定性**: 長期的なパートナーシップ

## 文言ソース
- **データソース**: `ascii-md/02_ses-sier-industry-structure_ascii.md`
- **画像**: `assets/images/industry.png`
- **アイコン**: SVGアイコンを使用

## 完了条件

### デザイン
- [ ] デザイントークンのみ使用（直書き禁止）
- [ ] 768px/1024pxで崩れない
- [ ] 業界構造図が適切に表示
- [ ] 強みカードが2列グリッドで表示

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
- [ ] 独自CSSは`components/_local-industry-structure.scss`に限定
- [ ] セマンティックHTML使用
- [ ] 適切なaria属性設定
