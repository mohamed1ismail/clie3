---
name: Nocturnal Opulence
colors:
  surface: '#131313'
  surface-dim: '#131313'
  surface-bright: '#393939'
  surface-container-lowest: '#0e0e0e'
  surface-container-low: '#1b1b1b'
  surface-container: '#1f1f1f'
  surface-container-high: '#2a2a2a'
  surface-container-highest: '#353535'
  on-surface: '#e2e2e2'
  on-surface-variant: '#d0c5af'
  inverse-surface: '#e2e2e2'
  inverse-on-surface: '#303030'
  outline: '#99907c'
  outline-variant: '#4d4635'
  surface-tint: '#e9c349'
  primary: '#f2ca50'
  on-primary: '#3c2f00'
  primary-container: '#d4af37'
  on-primary-container: '#554300'
  inverse-primary: '#735c00'
  secondary: '#c8c6c5'
  on-secondary: '#313030'
  secondary-container: '#4a4949'
  on-secondary-container: '#bab8b7'
  tertiary: '#cecece'
  on-tertiary: '#2f3131'
  tertiary-container: '#b2b3b3'
  on-tertiary-container: '#434546'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#ffe088'
  primary-fixed-dim: '#e9c349'
  on-primary-fixed: '#241a00'
  on-primary-fixed-variant: '#574500'
  secondary-fixed: '#e5e2e1'
  secondary-fixed-dim: '#c8c6c5'
  on-secondary-fixed: '#1c1b1b'
  on-secondary-fixed-variant: '#474646'
  tertiary-fixed: '#e2e2e2'
  tertiary-fixed-dim: '#c6c6c7'
  on-tertiary-fixed: '#1a1c1c'
  on-tertiary-fixed-variant: '#454747'
  background: '#131313'
  on-background: '#e2e2e2'
  surface-variant: '#353535'
typography:
  display-lg:
    fontFamily: Libre Caslon Text
    fontSize: 64px
    fontWeight: '400'
    lineHeight: 72px
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Libre Caslon Text
    fontSize: 40px
    fontWeight: '400'
    lineHeight: 48px
  headline-md:
    fontFamily: Libre Caslon Text
    fontSize: 32px
    fontWeight: '400'
    lineHeight: 40px
  body-lg:
    fontFamily: Manrope
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Manrope
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-caps:
    fontFamily: Manrope
    fontSize: 12px
    fontWeight: '700'
    lineHeight: 16px
    letterSpacing: 0.15em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  unit: 8px
  container-max: 1200px
  gutter: 24px
  margin-mobile: 20px
  margin-desktop: 64px
---

## Brand & Style

The design system embodies a "Nocturnal Opulence" aesthetic—a high-end, cinematic experience tailored for a luxury culinary brand. It targets a discerning audience seeking an atmospheric dining journey that bridges global traditions.

The style is a fusion of **Minimalism** and **Tactile Luxury**. It prioritizes deep, immersive blacks and rich textures to create a sense of mystery and exclusivity. Visuals are anchored by high-contrast food photography where light is used as a theatrical tool. The mood is intimate, refined, and undeniably premium, evoking the feeling of a candlelit table in a private lounge.

## Colors

The palette is strictly nocturnal, designed to make the metallic gold accents and vibrant food photography radiate.

- **Primary Gold (#D4AF37):** Used sparingly for key calls-to-action, borders, and brand-critical iconography. It should feel like an "illumination" rather than a fill.
- **Deep Neutral (#000000):** The primary background color, providing infinite depth.
- **Secondary Charcoal (#121212):** Used for UI layering and surface separation (cards, inputs).
- **Text Primary (#FFFFFF):** High-contrast white for maximum readability against dark backgrounds.
- **Text Secondary (#D4AF37):** Used for headlines or emphasis to maintain the "East and West" brand identity.

## Typography

The typography system balances the "East" (tradition/serif) and the "West" (modernity/sans-serif).

- **Headlines:** Uses *Libre Caslon Text*. This serif is authoritative and timeless. For large display titles, use "Gold" coloring or "White" with generous letter spacing to evoke luxury editorial design.
- **Body & UI:** Uses *Manrope*. A clean, modern sans-serif that ensures high legibility on dark backgrounds. It provides a technical, precise contrast to the romantic serif headings.
- **Arabic Pairing:** When displaying Arabic text, use a high-contrast Naskh-style typeface for headings to match the weight of Caslon, and a clean modern Kufi for body text.
- **Labels:** Small labels should always use uppercase with tracking (letter-spacing) set to at least 10-15% to maintain a sophisticated "brand" feel.

## Layout & Spacing

The layout philosophy is **Fixed and Spacious**. Content should never feel cramped; white space (or in this case, "black space") is treated as a luxury commodity.

- **Grid:** Use a 12-column grid for desktop with wide 64px margins to "center-stage" the content.
- **Vertical Rhythm:** Utilize an 8px base unit. Section spacing should be aggressive (e.g., 120px or 160px between major sections) to allow the photography to breathe.
- **Mobile:** Transition to a 4-column grid with 20px margins. Reduce vertical padding but maintain enough space so elements do not touch the edges of the viewport, preserving the "boutique" feel.

## Elevation & Depth

In a dark theme, depth is created through **Tonal Layering** and **Gold Accents** rather than heavy shadows.

- **Surfaces:** Use `#121212` for primary containers (cards, modals). This subtle lift from the `#000000` background creates a clear hierarchy.
- **Textures:** Apply a subtle "Brushed Metal" or "Fine Leather" grain overlay (at 3-5% opacity) to primary containers to enhance the tactile feel.
- **Borders:** Instead of shadows, use 1px "Ghost Borders" in a muted gold (`#8C7332`) or a linear gradient (Gold to Transparent) to define edges.
- **Glow:** For active states or high-priority buttons, use a very soft, diffused gold outer glow (e.g., `drop-shadow(0 0 15px rgba(212, 175, 55, 0.2))`).

## Shapes

The shape language is **Soft and Structural**. 

- **Primary Corners:** 0.25rem (4px) radius. This creates a sharp, professional look that isn't as aggressive as 0px but maintains a "tailored" appearance compared to overly rounded modern apps.
- **Large Containers:** Cards or featured sections use a slightly more pronounced 0.5rem (8px) radius.
- **Interactive Elements:** Buttons and inputs follow the 4px rule to keep the interface feeling architectural and crisp.

## Components

- **Buttons:** Primary buttons feature a solid gold background with black text. Secondary buttons are "Ghost" style with a 1px gold border and white text. All buttons should have a `label-caps` font style.
- **Input Fields:** Dark charcoal backgrounds with a bottom-only gold border (minimalist style). Labels should float above the field in muted gold.
- **Cards:** Use the "Fine Leather" texture overlay. Borders should be visible only on the top or left side as a "brand accent" line in gold.
- **Chips/Tags:** Small, pill-shaped with gold outlines. Used for dietary markers (e.g., "Vegan," "Chef's Special").
- **Lists (Menu):** Use the Serif font for item names and the Sans-serif font for descriptions. Prices should be highlighted in gold. Use a dotted leader line to connect the name to the price for a classic menu feel.
- **Dividers:** Use a "Diamond Compass" glyph (referencing the logo) in the center of horizontal lines to separate major content sections.