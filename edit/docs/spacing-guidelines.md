# スペーシングシステム ガイドライン

## 🎯 概要

**実務運用重視のスペーシングシステム**。8pxグリッドを主軸とし、4pxを補助として、継続運用のしやすさとチーム間の共通言語化を重視した設計です。

### 基本方針
- **8pxグリッド主軸、4px補助**: Google Material Design準拠
- **流動的スケーリング**: ブレークポイント固定ではなく、viewportに応じた自然な変化
- **抽象トークン管理**: `spacing.sm`、`spacing.md` などで統一管理
- **セマンティック余白ルール**: コンポーネントごとの明確なルール定義

## 📱 レスポンシブ対応（流動的スケーリング）

### 基本アプローチ
**固定ブレークポイントではなく、viewportに応じた流動的スケーリング**を採用

```css
html {
  font-size: clamp(14px, 1.2vw, 20px);
}
```

### デバイス別スケール
- **モバイル**: 0.75倍〜0.875倍に圧縮
- **タブレット/デスクトップ**: 100%（標準）
- **大型ディスプレイ**: 1.25倍に拡大

### 実装例
```css
/* 流動的スケーリング */
:root {
  --spacing-xs: clamp(2px, 0.5vw, 4px);
  --spacing-sm: clamp(4px, 1vw, 8px);
  --spacing-md: clamp(8px, 2vw, 16px);
  --spacing-lg: clamp(16px, 3vw, 24px);
  --spacing-xl: clamp(24px, 4vw, 40px);
  --spacing-2xl: clamp(32px, 6vw, 64px);
  --spacing-3xl: clamp(48px, 8vw, 96px);
}
```

## 🎨 レイアウトシステム

### ワンカラム（モバイル）
```
┌─────────────────┐
│     Header      │
├─────────────────┤
│    Content      │
│                 │
│                 │
├─────────────────┤
│     Footer      │
└─────────────────┘
```

**特徴**:
- 単一カラムレイアウト
- 縦積み配置
- 16pxのパディング
- 16pxの垂直スペーシング

### ツーカラム（タブレット）
```
┌─────────────────────────┐
│        Header           │
├─────────────┬───────────┤
│   Content   │  Sidebar  │
│             │           │
│             │           │
├─────────────┴───────────┤
│        Footer           │
└─────────────────────────┘
```

**特徴**:
- 2カラムレイアウト
- 24pxのパディング
- 24pxのガター
- 24pxの垂直スペーシング


## 📏 スペーシングスケール（Design Tokens）

### ベースユニット
- **主軸**: 8px（Google Material Design準拠）
- **補助**: 4px（細かい調整用）
- **スケール**: 4px, 8px, 12px, 16px, 20px, 24px, 32px, 40px, 48px, 64px, 80px, 96px

### 抽象トークン管理
```json
{
  "spacing": {
    "xs": { "value": "4px", "description": "最小単位" },
    "sm": { "value": "8px", "description": "小さい余白" },
    "md": { "value": "16px", "description": "標準余白" },
    "lg": { "value": "24px", "description": "大きい余白" },
    "xl": { "value": "40px", "description": "特大余白" },
    "2xl": { "value": "64px", "description": "セクション間" },
    "3xl": { "value": "96px", "description": "大セクション間" }
  }
}
```

### 4px補助の理由
- **視覚的にちょうど良い刻み幅**: 2pxだと細かすぎ、8pxだと粗すぎ
- **画面解像度と相性が良い**: アイコン、フォントサイズ、タップ領域が4の倍数
- **レスポンシブ設計に適応しやすい**: モバイル〜デスクトップまで調整しやすい



## 🧩 セマンティック余白ルール（コンポーネント別）

### ボタン
- **内側パディング**: `spacing.md` (16px) 固定
- **外側マージン**: `spacing.sm` (8px)
- **最小タップ領域**: 44px以上（モバイル必須）
- **例外ルール**: タップ領域確保のため、必要に応じてパディング拡張

### カード
- **内側パディング**: `spacing.md` (16px) 固定
- **外側マージン**: `spacing.lg` (24px)
- **カード間ギャップ**: `spacing.md` (16px)

### フォーム
- **フィールド間ギャップ**: `spacing.md` (16px)
- **ラベルとフィールド間**: `spacing.sm` (8px)
- **セクション間**: `spacing.lg` (24px)

### 見出し
- **H1と本文間**: `spacing.xl` (40px)
- **H2と本文間**: `spacing.lg` (24px)
- **H3と本文間**: `spacing.md` (16px)
- **見出し同士**: `spacing.2xl` (64px)

### セクション
- **セクション間**: `spacing.2xl` (64px)
- **大セクション間**: `spacing.3xl` (96px)
- **ヒーローセクション**: `spacing.3xl` (96px) 上下
## 🛠 実装方法（実務仕様）

### CSS実装（流動的スケーリング）
```css
/* 基本設定 */
:root {
  --spacing-xs: clamp(2px, 0.5vw, 4px);
  --spacing-sm: clamp(4px, 1vw, 8px);
  --spacing-md: clamp(8px, 2vw, 16px);
  --spacing-lg: clamp(16px, 3vw, 24px);
  --spacing-xl: clamp(24px, 4vw, 40px);
  --spacing-2xl: clamp(32px, 6vw, 64px);
  --spacing-3xl: clamp(48px, 8vw, 96px);
}

/* コンポーネント実装 */
.button {
  padding: var(--spacing-md);
  margin: var(--spacing-sm);
  min-height: 44px; /* タップ領域確保 */
}

.card {
  padding: var(--spacing-md);
  margin: var(--spacing-lg);
}

.section {
  padding: var(--spacing-2xl) 0;
}
```

### Tailwind CSS設定
```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      spacing: {
        'xs': 'clamp(2px, 0.5vw, 4px)',
        'sm': 'clamp(4px, 1vw, 8px)',
        'md': 'clamp(8px, 2vw, 16px)',
        'lg': 'clamp(16px, 3vw, 24px)',
        'xl': 'clamp(24px, 4vw, 40px)',
        '2xl': 'clamp(32px, 6vw, 64px)',
        '3xl': 'clamp(48px, 8vw, 96px)',
      }
    }
  }
}
```

### Figma Tokens設定
```json
{
  "spacing": {
    "xs": {
      "value": "4px",
      "type": "spacing",
      "description": "最小単位"
    },
    "sm": {
      "value": "8px", 
      "type": "spacing",
      "description": "小さい余白"
    },
    "md": {
      "value": "16px",
      "type": "spacing", 
      "description": "標準余白"
    },
    "lg": {
      "value": "24px",
      "type": "spacing",
      "description": "大きい余白"
    },
    "xl": {
      "value": "40px",
      "type": "spacing",
      "description": "特大余白"
    },
    "2xl": {
      "value": "64px",
      "type": "spacing",
      "description": "セクション間"
    },
    "3xl": {
      "value": "96px",
      "type": "spacing",
      "description": "大セクション間"
    }
  }
}
```

## 🚫 運用上の落とし穴と対策

### 禁止事項
- **スケール外の数値使用**: 5px、13px、27pxなどは禁止
- **自由な余白指定**: デザイナーが任意の数値を指定することを禁止
- **固定値の乱用**: レスポンシブ対応を無視した固定値の使用

### 例外ルールの明文化
```json
{
  "exceptions": {
    "tapTarget": {
      "minHeight": "44px",
      "reason": "アクセシビリティ要件",
      "override": "spacing.md を超える場合あり"
    },
    "formField": {
      "minHeight": "48px", 
      "reason": "フォームの使いやすさ",
      "override": "spacing.md を超える場合あり"
    },
    "iconSpacing": {
      "value": "4px",
      "reason": "アイコンの視覚的バランス",
      "override": "spacing.xs 固定"
    }
  }
}
```

### 品質保証チェックリスト
- [ ] 8pxグリッドの遵守（4px補助含む）
- [ ] 抽象トークンの使用（spacing.sm等）
- [ ] 流動的スケーリングの実装
- [ ] 最小タップ領域の確保（44px以上）
- [ ] 例外ルールの適切な適用
- [ ] デザイナー・エンジニア間の共通理解

## 🤖 AI生成対応

### 自動適用ルール
- **流動的スケーリング**: viewportに応じた自動調整
- **セマンティック余白**: コンポーネント種別に応じた自動適用
- **例外ルール**: アクセシビリティ要件の自動考慮

### 構造化データ
```json
{
  "spacing": {
    "type": "fluid",
    "base": "8px",
    "scale": ["xs", "sm", "md", "lg", "xl", "2xl", "3xl"],
    "components": {
      "button": "spacing.md",
      "card": "spacing.md", 
      "section": "spacing.2xl",
      "heading": "spacing.lg"
    },
    "exceptions": {
      "tapTarget": "44px",
      "formField": "48px"
    }
  }
}
```

## 📊 ベストプラクティスまとめ

### ✅ 実務運用で重要な5つのポイント

1. **8pxグリッドベース、4px補助** - 実務で最も安定
2. **流動的スケーリング** - rem / clamp() で自然な変化
3. **Design Tokenで抽象化管理** - spacing.sm などで統一
4. **セマンティック余白ルール** - コンポーネントごとの明確なルール
5. **例外ルールの明文化** - タップ領域やフォームUIなど

### 🎯 チーム間の共通言語化

#### デザイナー向け
- Figma Tokensで `spacing.sm` などの抽象名を使用
- スケール外の数値は禁止
- 例外ルールは必ず明文化

#### エンジニア向け
- CSS変数で `var(--spacing-md)` を使用
- clamp() で流動的スケーリング実装
- 最小タップ領域の確保

#### 運用担当向け
- 品質保証チェックリストの活用
- 例外ルールの適切な管理
- 継続的な改善とフィードバック収集

## 🚀 次のステップ

### 実装優先順位
1. **基本トークン定義** - spacing.sm などの抽象名
2. **流動的スケーリング** - clamp() の実装
3. **セマンティックルール** - コンポーネント別ルール
4. **例外ルール** - アクセシビリティ要件
5. **品質保証** - チェックリストとテスト

### 長期運用のポイント
- **継続的な改善**: ユーザーフィードバックの収集
- **バージョン管理**: トークンの変更履歴管理
- **チーム教育**: デザイナー・エンジニア間の共通理解
- **自動化**: AI生成での自動適用ルール
