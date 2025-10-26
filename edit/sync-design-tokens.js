#!/usr/bin/env node

/**
 * デザイントークン同期スクリプト
 * shared-design-tokens.json から各サイトの design-system.css を生成
 */

const fs = require('fs');
const path = require('path');

// 設定
const CONFIG = {
  sourceFile: './shared-design-tokens.json',
  targets: [
    {
      site: 'tenfive-recruit-clean',
      theme: 'recruitment',
      cssFile: './tenfive-recruit-clean/css/design-system.css'
    },
    {
      site: 'tenfive-corporate',
      theme: 'corporate',
      cssFile: './tenfive-corporate/css/design-system.css'
    }
  ]
};

/**
 * デザイントークンをCSS変数に変換
 */
function tokensToCSS(tokens, theme) {
  const base = tokens.base;
  const themeColors = tokens.themes[theme];
  
  let css = `/* ========================================
   テンファイブ${theme === 'recruitment' ? '採用サイト' : 'コーポレートサイト'} - デザインシステム
   ======================================== */

/* CSS Custom Properties - デザインシステムのトークン */
:root {
`;

  // ベースカラー
  css += `  /* ベースカラー */\n`;
  Object.entries(base.colors.neutral).forEach(([key, value]) => {
    css += `  --color-neutral-${key}: ${value};\n`;
  });
  
  Object.entries(base.colors.semantic).forEach(([key, value]) => {
    css += `  --color-${key}: ${value};\n`;
  });

  // テーマカラー
  css += `\n  /* テーマカラー - ${themeColors.name} */\n`;
  Object.entries(themeColors.colors).forEach(([colorType, shades]) => {
    Object.entries(shades).forEach(([shade, value]) => {
      css += `  --color-${colorType}-${shade}: ${value};\n`;
    });
  });

  // タイポグラフィ
  css += `\n  /* タイポグラフィ */\n`;
  css += `  --font-family-primary: ${base.typography.fonts.primary};\n`;
  css += `  --font-family-secondary: ${base.typography.fonts.secondary};\n`;
  css += `  --font-family-monospace: ${base.typography.fonts.monospace};\n\n`;
  
  css += `  /* フォントサイズ */\n`;
  Object.entries(base.typography.sizes).forEach(([key, value]) => {
    css += `  --font-size-${key}: ${value};\n`;
  });
  
  css += `\n  /* フォントウェイト */\n`;
  Object.entries(base.typography.weights).forEach(([key, value]) => {
    css += `  --font-weight-${key}: ${value};\n`;
  });
  
  css += `\n  /* ライン高さ */\n`;
  Object.entries(base.typography.lineHeights).forEach(([key, value]) => {
    css += `  --line-height-${key}: ${value};\n`;
  });

  // スペーシング
  css += `\n  /* スペーシング - 8pxベース */\n`;
  Object.entries(base.spacing).forEach(([key, value]) => {
    css += `  --spacing-${key}: ${value};\n`;
  });
  
  css += `\n  /* 後方互換性のためのエイリアス */\n`;
  css += `  --spacing-xs: var(--spacing-1);\n`;
  css += `  --spacing-sm: var(--spacing-2);\n`;
  css += `  --spacing-md: var(--spacing-4);\n`;
  css += `  --spacing-lg: var(--spacing-6);\n`;
  css += `  --spacing-xl: var(--spacing-8);\n`;
  css += `  --spacing-2xl: var(--spacing-12);\n`;
  css += `  --spacing-3xl: var(--spacing-16);\n`;
  css += `  --spacing-4xl: var(--spacing-24);\n`;

  // ボーダーラディウス
  css += `\n  /* ボーダーラディウス */\n`;
  Object.entries(base.radius).forEach(([key, value]) => {
    css += `  --radius-${key}: ${value};\n`;
  });

  // シャドウ
  css += `\n  /* シャドウ */\n`;
  Object.entries(base.shadows).forEach(([key, value]) => {
    css += `  --shadow-${key}: ${value};\n`;
  });

  // トランジション
  css += `\n  /* トランジション */\n`;
  Object.entries(base.transitions).forEach(([key, value]) => {
    css += `  --transition-${key}: ${value};\n`;
  });

  // ブレークポイント
  css += `\n  /* ブレークポイント */\n`;
  Object.entries(base.breakpoints).forEach(([key, value]) => {
    css += `  --breakpoint-${key}: ${value};\n`;
  });

  // 追加のCSS変数（サイト共通）
  css += `\n  /* 追加のユーティリティ */\n`;
  css += `  --container-max-width: 1200px;\n`;
  css += `  --container-padding: var(--spacing-4);\n`;
  css += `  --z-dropdown: 1000;\n`;
  css += `  --z-sticky: 1020;\n`;
  css += `  --z-fixed: 1030;\n`;
  css += `  --z-modal: 1040;\n`;
  css += `  --z-popover: 1050;\n`;
  css += `  --z-tooltip: 1060;\n`;

  css += `}\n\n`;

  // ベーススタイル（共通）
  css += `/* リセットとベーススタイル */
*,
*::before,
*::after {
  box-sizing: border-box;
}

* {
  margin: 0;
  padding: 0;
}

html {
  font-size: 16px;
  line-height: 1.5;
  -webkit-text-size-adjust: 100%;
  -moz-text-size-adjust: 100%;
  text-size-adjust: 100%;
}

body {
  font-family: var(--font-family-primary);
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-normal);
  line-height: var(--line-height-normal);
  color: var(--color-neutral-900);
  background-color: var(--color-neutral-white);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* タイポグラフィ */
h1, h2, h3, h4, h5, h6 {
  font-family: var(--font-family-primary);
  font-weight: var(--font-weight-semibold);
  line-height: var(--line-height-tight);
  color: var(--color-neutral-900);
  margin-bottom: var(--spacing-md);
}

h1 { font-size: var(--font-size-4xl); }
h2 { font-size: var(--font-size-3xl); }
h3 { font-size: var(--font-size-2xl); }
h4 { font-size: var(--font-size-xl); }
h5 { font-size: var(--font-size-lg); }
h6 { font-size: var(--font-size-base); }

p {
  margin-bottom: var(--spacing-md);
  line-height: var(--line-height-relaxed);
}

a {
  color: var(--color-primary-600);
  text-decoration: none;
  transition: color var(--transition-fast);
}

a:hover {
  color: var(--color-primary-700);
}

/* コンテナ */
.container {
  width: 100%;
  max-width: var(--container-max-width);
  margin: 0 auto;
  padding: 0 var(--container-padding);
}

/* レスポンシブ対応 */
@media (min-width: 640px) {
  :root {
    --container-padding: var(--spacing-lg);
  }
  
  h1 { font-size: var(--font-size-5xl); }
  h2 { font-size: var(--font-size-4xl); }
}

@media (min-width: 1024px) {
  :root {
    --container-padding: var(--spacing-xl);
  }
}
`;

  return css;
}

/**
 * メイン処理
 */
function main() {
  console.log('🎨 デザイントークン同期を開始...\n');

  try {
    // ソースファイルを読み込み
    const sourcePath = path.resolve(CONFIG.sourceFile);
    if (!fs.existsSync(sourcePath)) {
      throw new Error(`ソースファイルが見つかりません: ${sourcePath}`);
    }

    const tokens = JSON.parse(fs.readFileSync(sourcePath, 'utf8'));
    console.log(`✅ ソースファイルを読み込み: ${CONFIG.sourceFile}`);

    // 各サイトのCSSファイルを生成
    CONFIG.targets.forEach(target => {
      const css = tokensToCSS(tokens, target.theme);
      const outputPath = path.resolve(target.cssFile);
      
      // ディレクトリが存在しない場合は作成
      const dir = path.dirname(outputPath);
      if (!fs.existsSync(dir)) {
        fs.mkdirSync(dir, { recursive: true });
      }
      
      // CSSファイルを書き込み
      fs.writeFileSync(outputPath, css, 'utf8');
      console.log(`✅ ${target.site} のCSSを生成: ${target.cssFile}`);
    });

    console.log('\n🎉 デザイントークン同期が完了しました！');
    console.log('\n📋 次のステップ:');
    console.log('1. 各サイトでビジュアルテストを実行');
    console.log('2. 変更内容を確認');
    console.log('3. 必要に応じてコミット');

  } catch (error) {
    console.error('❌ エラーが発生しました:', error.message);
    process.exit(1);
  }
}

// スクリプト実行
if (require.main === module) {
  main();
}

module.exports = { tokensToCSS, main };
