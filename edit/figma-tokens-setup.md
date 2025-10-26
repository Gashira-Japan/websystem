# Figma Tokens セットアップガイド

## 🎯 概要

GPT-5とFigmaを連携させるためのFigma Tokens設定ガイドです。デザインシステムのトークンをFigma上で管理し、AI生成に対応した構造化データを作成します。

## 🛠 セットアップ手順

### 1. Figma Tokens プラグインのインストール

#### インストール方法
1. **Figmaを開く**
2. **Plugins → Browse all plugins**
3. **「Figma Tokens」を検索**
4. **Install**をクリック

#### 初回設定
1. **Plugins → Figma Tokens**
2. **「Create new token set」をクリック**
3. **「Import from JSON」を選択**
4. **既存のJSONファイルをインポート**

### 2. デザイントークンのインポート

#### カラーシステムのインポート
```json
{
  "colors": {
    "primary": {
      "value": "#3B82F6",
      "type": "color",
      "description": "プライマリカラー"
    },
    "secondary": {
      "value": "#6B7280",
      "type": "color",
      "description": "セカンダリカラー"
    },
    "success": {
      "value": "#10B981",
      "type": "color",
      "description": "成功カラー"
    },
    "warning": {
      "value": "#F59E0B",
      "type": "color",
      "description": "警告カラー"
    },
    "error": {
      "value": "#EF4444",
      "type": "color",
      "description": "エラーカラー"
    }
  }
}
```

#### タイポグラフィシステムのインポート
```json
{
  "typography": {
    "fontFamily": {
      "primary": {
        "value": "Noto Sans JP",
        "type": "fontFamily",
        "description": "プライマリフォント"
      },
      "secondary": {
        "value": "Noto Serif JP",
        "type": "fontFamily",
        "description": "セカンダリフォント"
      },
      "mono": {
        "value": "JetBrains Mono",
        "type": "fontFamily",
        "description": "等幅フォント"
      }
    },
    "fontSize": {
      "xs": {
        "value": "clamp(12px, 0.75rem, 14px)",
        "type": "fontSize",
        "description": "極小サイズ"
      },
      "sm": {
        "value": "clamp(14px, 0.875rem, 16px)",
        "type": "fontSize",
        "description": "小サイズ"
      },
      "base": {
        "value": "clamp(16px, 1rem, 18px)",
        "type": "fontSize",
        "description": "ベースサイズ"
      },
      "lg": {
        "value": "clamp(18px, 1.125rem, 20px)",
        "type": "fontSize",
        "description": "大サイズ"
      },
      "xl": {
        "value": "clamp(20px, 1.25rem, 24px)",
        "type": "fontSize",
        "description": "特大サイズ"
      }
    },
    "fontWeight": {
      "normal": {
        "value": "400",
        "type": "fontWeight",
        "description": "標準"
      },
      "medium": {
        "value": "500",
        "type": "fontWeight",
        "description": "中太"
      },
      "semibold": {
        "value": "600",
        "type": "fontWeight",
        "description": "半太"
      },
      "bold": {
        "value": "700",
        "type": "fontWeight",
        "description": "太"
      }
    }
  }
}
```

#### スペーシングシステムのインポート
```json
{
  "spacing": {
    "xs": {
      "value": "clamp(2px, 0.5vw, 4px)",
      "type": "spacing",
      "description": "最小単位"
    },
    "sm": {
      "value": "clamp(4px, 1vw, 8px)",
      "type": "spacing",
      "description": "小さい余白"
    },
    "md": {
      "value": "clamp(8px, 2vw, 16px)",
      "type": "spacing",
      "description": "標準余白"
    },
    "lg": {
      "value": "clamp(16px, 3vw, 24px)",
      "type": "spacing",
      "description": "大きい余白"
    },
    "xl": {
      "value": "clamp(24px, 4vw, 40px)",
      "type": "spacing",
      "description": "特大余白"
    },
    "2xl": {
      "value": "clamp(32px, 6vw, 64px)",
      "type": "spacing",
      "description": "セクション間"
    },
    "3xl": {
      "value": "clamp(48px, 8vw, 96px)",
      "type": "spacing",
      "description": "大セクション間"
    }
  }
}
```

### 3. コンポーネントライブラリの作成

#### ボタンコンポーネント
```json
{
  "components": {
    "button": {
      "primary": {
        "backgroundColor": "{colors.primary}",
        "color": "#FFFFFF",
        "padding": "{spacing.md}",
        "borderRadius": "4px",
        "fontFamily": "{typography.fontFamily.primary}",
        "fontSize": "{typography.fontSize.base}",
        "fontWeight": "{typography.fontWeight.medium}",
        "minHeight": "44px"
      },
      "secondary": {
        "backgroundColor": "{colors.secondary}",
        "color": "#FFFFFF",
        "padding": "{spacing.md}",
        "borderRadius": "4px",
        "fontFamily": "{typography.fontFamily.primary}",
        "fontSize": "{typography.fontSize.base}",
        "fontWeight": "{typography.fontWeight.medium}",
        "minHeight": "44px"
      },
      "tertiary": {
        "backgroundColor": "transparent",
        "color": "{colors.primary}",
        "border": "1px solid {colors.primary}",
        "padding": "{spacing.md}",
        "borderRadius": "4px",
        "fontFamily": "{typography.fontFamily.primary}",
        "fontSize": "{typography.fontSize.base}",
        "fontWeight": "{typography.fontWeight.medium}",
        "minHeight": "44px"
      }
    }
  }
}
```

#### カードコンポーネント
```json
{
  "components": {
    "card": {
      "default": {
        "backgroundColor": "#FFFFFF",
        "border": "1px solid #E5E7EB",
        "borderRadius": "8px",
        "padding": "{spacing.md}",
        "margin": "{spacing.lg}",
        "boxShadow": "0 1px 3px rgba(0, 0, 0, 0.1)"
      },
      "elevated": {
        "backgroundColor": "#FFFFFF",
        "border": "none",
        "borderRadius": "8px",
        "padding": "{spacing.md}",
        "margin": "{spacing.lg}",
        "boxShadow": "0 4px 6px rgba(0, 0, 0, 0.1)"
      },
      "outlined": {
        "backgroundColor": "#FFFFFF",
        "border": "2px solid {colors.primary}",
        "borderRadius": "8px",
        "padding": "{spacing.md}",
        "margin": "{spacing.lg}",
        "boxShadow": "none"
      }
    }
  }
}
```

### 4. AI生成対応の設定

#### 構造化データの作成
```json
{
  "aiGeneration": {
    "rules": {
      "colorSelection": {
        "primary": "主要なアクション、重要な要素",
        "secondary": "補助的なアクション、サブ要素",
        "success": "成功状態、完了状態",
        "warning": "注意状態、警告状態",
        "error": "エラー状態、失敗状態"
      },
      "spacingRules": {
        "component": "spacing.md",
        "section": "spacing.2xl",
        "hero": "spacing.3xl"
      },
      "typographyRules": {
        "heading": "font-size-lg",
        "body": "font-size-base",
        "caption": "font-size-sm"
      }
    },
    "components": {
      "button": {
        "autoSelect": "用途に応じて自動選択",
        "size": "コンテキストに応じて自動調整",
        "state": "インタラクション状態を自動管理"
      },
      "card": {
        "layout": "コンテンツ量に応じて自動調整",
        "spacing": "8pxグリッドシステムに基づく自動適用"
      }
    }
  }
}
```

### 5. レスポンシブ対応の設定

#### ブレークポイントの定義
```json
{
  "breakpoints": {
    "mobile": {
      "min": 0,
      "max": 767,
      "description": "モバイルデバイス",
      "scale": 0.75
    },
    "tablet": {
      "min": 768,
      "max": 1023,
      "description": "タブレットデバイス",
      "scale": 1.0
    },
    "desktop": {
      "min": 1024,
      "max": 1439,
      "description": "デスクトップデバイス",
      "scale": 1.0
    },
    "largeDesktop": {
      "min": 1440,
      "max": 9999,
      "description": "大型デスクトップデバイス",
      "scale": 1.25
    }
  }
}
```

#### レスポンシブトークンの設定
```json
{
  "responsive": {
    "spacing": {
      "mobile": {
        "xs": "2px",
        "sm": "4px",
        "md": "8px",
        "lg": "12px",
        "xl": "20px",
        "2xl": "32px",
        "3xl": "48px"
      },
      "tablet": {
        "xs": "4px",
        "sm": "8px",
        "md": "16px",
        "lg": "24px",
        "xl": "40px",
        "2xl": "64px",
        "3xl": "96px"
      },
      "desktop": {
        "xs": "4px",
        "sm": "8px",
        "md": "16px",
        "lg": "24px",
        "xl": "40px",
        "2xl": "64px",
        "3xl": "96px"
      }
    }
  }
}
```

### 6. エクスポート設定

#### CSS変数のエクスポート
```json
{
  "export": {
    "css": {
      "format": "css-variables",
      "prefix": "--",
      "output": "design-tokens.css"
    },
    "scss": {
      "format": "scss-variables",
      "prefix": "$",
      "output": "design-tokens.scss"
    },
    "json": {
      "format": "json",
      "output": "design-tokens.json"
    }
  }
}
```

#### Figmaスタイルの同期
```json
{
  "sync": {
    "colors": {
      "autoSync": true,
      "createStyles": true,
      "updateStyles": true
    },
    "typography": {
      "autoSync": true,
      "createStyles": true,
      "updateStyles": true
    },
    "spacing": {
      "autoSync": true,
      "createStyles": false,
      "updateStyles": false
    }
  }
}
```

## 🤖 AI生成との連携

### GPT-5プロンプト用のデータ構造
```json
{
  "figmaTokens": {
    "colors": {
      "primary": "#3B82F6",
      "secondary": "#6B7280",
      "success": "#10B981",
      "warning": "#F59E0B",
      "error": "#EF4444"
    },
    "typography": {
      "fontFamily": {
        "primary": "Noto Sans JP",
        "secondary": "Noto Serif JP",
        "mono": "JetBrains Mono"
      },
      "fontSize": {
        "xs": "clamp(12px, 0.75rem, 14px)",
        "sm": "clamp(14px, 0.875rem, 16px)",
        "base": "clamp(16px, 1rem, 18px)",
        "lg": "clamp(18px, 1.125rem, 20px)",
        "xl": "clamp(20px, 1.25rem, 24px)"
      }
    },
    "spacing": {
      "xs": "clamp(2px, 0.5vw, 4px)",
      "sm": "clamp(4px, 1vw, 8px)",
      "md": "clamp(8px, 2vw, 16px)",
      "lg": "clamp(16px, 3vw, 24px)",
      "xl": "clamp(24px, 4vw, 40px)",
      "2xl": "clamp(32px, 6vw, 64px)",
      "3xl": "clamp(48px, 8vw, 96px)"
    },
    "components": {
      "button": {
        "primary": "プライマリボタンのスタイル",
        "secondary": "セカンダリボタンのスタイル",
        "tertiary": "ターシャリボタンのスタイル"
      },
      "card": {
        "default": "標準カードのスタイル",
        "elevated": "浮き上がったカードのスタイル",
        "outlined": "枠線強調カードのスタイル"
      }
    }
  }
}
```

### 自動生成ルールの設定
```json
{
  "aiRules": {
    "colorSelection": {
      "action": "primary",
      "information": "secondary",
      "success": "success",
      "warning": "warning",
      "error": "error"
    },
    "spacingRules": {
      "component": "md",
      "section": "2xl",
      "hero": "3xl"
    },
    "typographyRules": {
      "heading": "lg",
      "body": "base",
      "caption": "sm"
    }
  }
}
```

## 📊 品質保証

### チェックリスト
- [ ] デザイントークンの一貫性
- [ ] レスポンシブ対応
- [ ] アクセシビリティ対応
- [ ] AI生成ルールの正確性
- [ ] エクスポート設定の確認

### テスト方法
- [ ] トークンの適用テスト
- [ ] レスポンシブテスト
- [ ] アクセシビリティテスト
- [ ] AI生成テスト

## 🚀 次のステップ

### 実装準備
1. **Figma Tokensの設定完了**
2. **デザイントークンのインポート完了**
3. **コンポーネントライブラリの作成完了**
4. **AI生成ルールの設定完了**

### 統合テスト
1. **GPT-5との連携テスト**
2. **自動生成の品質確認**
3. **修正・改善の実施**
4. **最終承認**

---

**注意**: このセットアップはGPT-5とFigmaの連携を前提としています。各設定が正確に完了していることを確認してから、AI生成ワークフローを開始してください。
