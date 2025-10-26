# コンポーネント仕様書 - AI生成用

## 🎯 概要

GPT-5がコンポーネントを生成する際の詳細仕様書です。各コンポーネントの構造、状態、バリエーションを定義し、一貫性のあるUIコンポーネントを自動生成します。

## 🧩 コンポーネント一覧

### 1. Button（ボタン）

#### 基本仕様
- **用途**: アクションの実行、ナビゲーション
- **最小タップ領域**: 44px以上（アクセシビリティ要件）
- **パディング**: `spacing.md` (16px) 固定
- **マージン**: `spacing.sm` (8px)

#### バリエーション
```json
{
  "button": {
    "variants": {
      "primary": {
        "backgroundColor": "#3B82F6",
        "color": "#FFFFFF",
        "border": "none",
        "description": "主要なアクション用"
      },
      "secondary": {
        "backgroundColor": "#6B7280",
        "color": "#FFFFFF",
        "border": "none",
        "description": "補助的なアクション用"
      },
      "tertiary": {
        "backgroundColor": "transparent",
        "color": "#3B82F6",
        "border": "1px solid #3B82F6",
        "description": "軽いアクション用"
      }
    },
    "sizes": {
      "small": {
        "padding": "8px 16px",
        "fontSize": "14px",
        "minHeight": "32px"
      },
      "medium": {
        "padding": "12px 24px",
        "fontSize": "16px",
        "minHeight": "44px"
      },
      "large": {
        "padding": "16px 32px",
        "fontSize": "18px",
        "minHeight": "56px"
      }
    },
    "states": {
      "default": "基本状態",
      "hover": "マウスオーバー時",
      "active": "クリック時",
      "disabled": "無効状態"
    }
  }
}
```

#### 実装例
```scss
.button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: var(--spacing-md);
  margin: var(--spacing-sm);
  min-height: 44px;
  border: none;
  border-radius: 4px;
  font-family: var(--font-family-primary);
  font-size: var(--font-size-base);
  font-weight: 500;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
  
  &--primary {
    background-color: var(--color-primary);
    color: white;
    
    &:hover {
      background-color: #2563EB;
    }
  }
}
```

### 2. Card（カード）

#### 基本仕様
- **用途**: コンテンツのグループ化、情報の整理
- **パディング**: `spacing.md` (16px) 固定
- **マージン**: `spacing.lg` (24px)
- **ギャップ**: `spacing.md` (16px)

#### バリエーション
```json
{
  "card": {
    "variants": {
      "default": {
        "backgroundColor": "#FFFFFF",
        "border": "1px solid #E5E7EB",
        "boxShadow": "0 1px 3px rgba(0, 0, 0, 0.1)",
        "description": "標準カード"
      },
      "elevated": {
        "backgroundColor": "#FFFFFF",
        "border": "none",
        "boxShadow": "0 4px 6px rgba(0, 0, 0, 0.1)",
        "description": "浮き上がったカード"
      },
      "outlined": {
        "backgroundColor": "#FFFFFF",
        "border": "2px solid #3B82F6",
        "boxShadow": "none",
        "description": "枠線強調カード"
      }
    },
    "sections": {
      "header": {
        "padding": "var(--spacing-md)",
        "borderBottom": "1px solid #E5E7EB",
        "description": "ヘッダーセクション"
      },
      "content": {
        "padding": "var(--spacing-md)",
        "description": "コンテンツセクション"
      },
      "footer": {
        "padding": "var(--spacing-md)",
        "borderTop": "1px solid #E5E7EB",
        "description": "フッターセクション"
      }
    }
  }
}
```

#### 実装例
```scss
.card {
  padding: var(--spacing-md);
  margin: var(--spacing-lg);
  border: 1px solid #E5E7EB;
  border-radius: 8px;
  background-color: white;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  
  &__header {
    margin-bottom: var(--spacing-md);
    padding-bottom: var(--spacing-md);
    border-bottom: 1px solid #E5E7EB;
  }
  
  &__content {
    margin-bottom: var(--spacing-md);
  }
  
  &__footer {
    margin-top: var(--spacing-md);
    padding-top: var(--spacing-md);
    border-top: 1px solid #E5E7EB;
  }
}
```

### 3. Form（フォーム）

#### 基本仕様
- **用途**: データ入力、ユーザー情報収集
- **フィールド間ギャップ**: `spacing.md` (16px)
- **ラベルとフィールド間**: `spacing.sm` (8px)
- **セクション間**: `spacing.lg` (24px)
- **最小高さ**: 48px（フォームの使いやすさ）

#### バリエーション
```json
{
  "form": {
    "elements": {
      "input": {
        "padding": "12px 16px",
        "border": "1px solid #D1D5DB",
        "borderRadius": "4px",
        "fontSize": "16px",
        "minHeight": "48px"
      },
      "textarea": {
        "padding": "12px 16px",
        "border": "1px solid #D1D5DB",
        "borderRadius": "4px",
        "fontSize": "16px",
        "minHeight": "100px",
        "resize": "vertical"
      },
      "select": {
        "padding": "12px 16px",
        "border": "1px solid #D1D5DB",
        "borderRadius": "4px",
        "fontSize": "16px",
        "minHeight": "48px"
      }
    },
    "states": {
      "default": "基本状態",
      "focus": "フォーカス時",
      "error": "エラー状態",
      "success": "成功状態",
      "disabled": "無効状態"
    },
    "validation": {
      "error": {
        "borderColor": "#EF4444",
        "color": "#EF4444",
        "description": "エラーメッセージ"
      },
      "success": {
        "borderColor": "#10B981",
        "color": "#10B981",
        "description": "成功メッセージ"
      }
    }
  }
}
```

#### 実装例
```scss
.form {
  &__field {
    margin-bottom: var(--spacing-md);
  }
  
  &__label {
    display: block;
    margin-bottom: var(--spacing-sm);
    font-weight: 500;
    color: var(--color-text-primary);
  }
  
  &__input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #D1D5DB;
    border-radius: 4px;
    font-size: 16px;
    min-height: 48px;
    transition: border-color 0.2s ease-in-out;
    
    &:focus {
      outline: none;
      border-color: var(--color-primary);
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    &--error {
      border-color: var(--color-error);
    }
    
    &--success {
      border-color: var(--color-success);
    }
  }
  
  &__error {
    margin-top: var(--spacing-sm);
    color: var(--color-error);
    font-size: 14px;
  }
}
```

### 4. Navigation（ナビゲーション）

#### 基本仕様
- **用途**: サイト内ナビゲーション、ページ間移動
- **高さ**: 64px（デスクトップ）、56px（モバイル）
- **パディング**: `spacing.md` (16px)
- **ギャップ**: `spacing.md` (16px)

#### バリエーション
```json
{
  "navigation": {
    "types": {
      "header": {
        "position": "fixed",
        "top": "0",
        "backgroundColor": "#FFFFFF",
        "boxShadow": "0 1px 3px rgba(0, 0, 0, 0.1)",
        "description": "ヘッダーナビゲーション"
      },
      "sidebar": {
        "position": "fixed",
        "left": "0",
        "width": "256px",
        "backgroundColor": "#F9FAFB",
        "description": "サイドバーナビゲーション"
      },
      "footer": {
        "backgroundColor": "#1F2937",
        "color": "#FFFFFF",
        "description": "フッターナビゲーション"
      }
    },
    "items": {
      "link": {
        "padding": "8px 16px",
        "color": "#6B7280",
        "textDecoration": "none",
        "transition": "color 0.2s ease-in-out"
      },
      "active": {
        "color": "#3B82F6",
        "fontWeight": "500"
      },
      "hover": {
        "color": "#3B82F6"
      }
    }
  }
}
```

#### 実装例
```scss
.navigation {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 64px;
  padding: 0 var(--spacing-md);
  background-color: white;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  
  &__logo {
    font-size: var(--font-size-xl);
    font-weight: 700;
    color: var(--color-primary);
    text-decoration: none;
  }
  
  &__menu {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
  }
  
  &__link {
    padding: 8px 16px;
    color: var(--color-text-secondary);
    text-decoration: none;
    transition: color 0.2s ease-in-out;
    
    &:hover {
      color: var(--color-primary);
    }
    
    &--active {
      color: var(--color-primary);
      font-weight: 500;
    }
  }
}
```

### 5. Modal（モーダル）

#### 基本仕様
- **用途**: 重要な情報表示、確認ダイアログ
- **オーバーレイ**: 半透明の背景
- **位置**: 画面中央
- **サイズ**: 最大幅600px、最大高さ80vh

#### バリエーション
```json
{
  "modal": {
    "overlay": {
      "position": "fixed",
      "top": "0",
      "left": "0",
      "width": "100%",
      "height": "100%",
      "backgroundColor": "rgba(0, 0, 0, 0.5)",
      "zIndex": "1000"
    },
    "content": {
      "position": "fixed",
      "top": "50%",
      "left": "50%",
      "transform": "translate(-50%, -50%)",
      "maxWidth": "600px",
      "maxHeight": "80vh",
      "backgroundColor": "#FFFFFF",
      "borderRadius": "8px",
      "boxShadow": "0 10px 25px rgba(0, 0, 0, 0.2)"
    },
    "header": {
      "padding": "var(--spacing-lg)",
      "borderBottom": "1px solid #E5E7EB"
    },
    "body": {
      "padding": "var(--spacing-lg)"
    },
    "footer": {
      "padding": "var(--spacing-lg)",
      "borderTop": "1px solid #E5E7EB"
    }
  }
}
```

#### 実装例
```scss
.modal {
  &__overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
  }
  
  &__content {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 600px;
    max-height: 80vh;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    overflow: hidden;
  }
  
  &__header {
    padding: var(--spacing-lg);
    border-bottom: 1px solid #E5E7EB;
  }
  
  &__body {
    padding: var(--spacing-lg);
  }
  
  &__footer {
    padding: var(--spacing-lg);
    border-top: 1px solid #E5E7EB;
  }
}
```

## 📱 レスポンシブ対応

### ブレークポイント
```json
{
  "breakpoints": {
    "mobile": "0-767px",
    "tablet": "768-1023px",
    "desktop": "1024px+"
  }
}
```

### コンポーネント別レスポンシブ
```json
{
  "responsive": {
    "button": {
      "mobile": {
        "padding": "12px 20px",
        "fontSize": "16px",
        "minHeight": "44px"
      },
      "tablet": {
        "padding": "12px 24px",
        "fontSize": "16px",
        "minHeight": "44px"
      },
      "desktop": {
        "padding": "16px 32px",
        "fontSize": "18px",
        "minHeight": "56px"
      }
    },
    "card": {
      "mobile": {
        "padding": "16px",
        "margin": "16px"
      },
      "tablet": {
        "padding": "20px",
        "margin": "20px"
      },
      "desktop": {
        "padding": "24px",
        "margin": "24px"
      }
    }
  }
}
```

## ♿ アクセシビリティ

### キーボードナビゲーション
- **Tab**: 次の要素にフォーカス
- **Shift + Tab**: 前の要素にフォーカス
- **Enter/Space**: アクティベート
- **Escape**: モーダルを閉じる

### スクリーンリーダー対応
- **aria-label**: 要素の説明
- **aria-describedby**: 詳細説明の参照
- **role**: 要素の役割
- **aria-expanded**: 展開状態

### フォーカス管理
- **フォーカス表示**: 2px solid #3B82F6
- **フォーカスオフセット**: 2px
- **フォーカストラップ**: モーダル内でのフォーカス管理

## 🚀 AI生成ルール

### 自動適用ルール
```json
{
  "generationRules": {
    "button": {
      "autoSelect": "用途に応じて自動選択",
      "size": "コンテキストに応じて自動調整",
      "state": "インタラクション状態を自動管理"
    },
    "card": {
      "layout": "コンテンツ量に応じて自動調整",
      "spacing": "8pxグリッドシステムに基づく自動適用"
    },
    "form": {
      "validation": "入力タイプに応じて自動設定",
      "layout": "フィールド数に応じて自動調整"
    }
  }
}
```

### 構造化データ
```json
{
  "componentData": {
    "type": "button",
    "variant": "primary",
    "size": "medium",
    "state": "default",
    "accessibility": {
      "ariaLabel": "ボタンの説明",
      "role": "button"
    },
    "responsive": {
      "mobile": "適応されたスタイル",
      "tablet": "適応されたスタイル",
      "desktop": "適応されたスタイル"
    }
  }
}
```

---

**注意**: この仕様書はGPT-5がコンポーネントを生成する際の詳細仕様です。一貫性のあるUIコンポーネントを構築するため、必ずこの仕様に従ってコンポーネントを生成してください。
