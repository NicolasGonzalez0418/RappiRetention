---
name: Modern Fintech Retention System
colors:
  surface: '#f8f9ff'
  surface-dim: '#cbdbf5'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e5eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d3e4fe'
  on-surface: '#0b1c30'
  on-surface-variant: '#434656'
  inverse-surface: '#213145'
  inverse-on-surface: '#eaf1ff'
  outline: '#737688'
  outline-variant: '#c3c5d9'
  surface-tint: '#004ced'
  primary: '#003ec7'
  on-primary: '#ffffff'
  primary-container: '#0052ff'
  on-primary-container: '#dfe3ff'
  inverse-primary: '#b7c4ff'
  secondary: '#565e74'
  on-secondary: '#ffffff'
  secondary-container: '#dae2fd'
  on-secondary-container: '#5c647a'
  tertiary: '#952200'
  on-tertiary: '#ffffff'
  tertiary-container: '#bf3003'
  on-tertiary-container: '#ffddd5'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dde1ff'
  primary-fixed-dim: '#b7c4ff'
  on-primary-fixed: '#001452'
  on-primary-fixed-variant: '#0038b6'
  secondary-fixed: '#dae2fd'
  secondary-fixed-dim: '#bec6e0'
  on-secondary-fixed: '#131b2e'
  on-secondary-fixed-variant: '#3f465c'
  tertiary-fixed: '#ffdbd2'
  tertiary-fixed-dim: '#ffb4a1'
  on-tertiary-fixed: '#3c0800'
  on-tertiary-fixed-variant: '#891e00'
  background: '#f8f9ff'
  on-background: '#0b1c30'
  surface-variant: '#d3e4fe'
typography:
  display-lg:
    fontFamily: Inter
    fontSize: 36px
    fontWeight: '700'
    lineHeight: 44px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
    letterSpacing: -0.01em
  title-sm:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '600'
    lineHeight: 24px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-caps:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
  data-mono:
    fontFamily: JetBrains Mono
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  margin-canvas: 32px
  gutter-grid: 24px
  sidebar-width: 280px
  padding-card: 24px
---

## Brand & Style

This design system is engineered for high-density data environments where clarity and trust are paramount. The brand personality is **authoritative, analytical, and precise**, designed to reduce the cognitive load of churn analysis and customer health monitoring. 

The style follows a **Modern Corporate** aesthetic with a heavy emphasis on information hierarchy. It utilizes a sophisticated "Light-to-Main" contrast strategy: a clean, airy navigation sidebar paired with a structured, data-rich main canvas. The emotional response should be one of control and clarity, allowing users to identify "at-risk" segments through immediate visual cues without feeling overwhelmed by the volume of data.

## Colors

The palette is anchored by **Deep Slate (Dark Blue)** for core structural elements and navigation text, paired with a **Vibrant Blue (Light Blue)** for primary actions and interactive states. 

The risk segmentation utilizes a high-contrast functional palette:
- **Low Risk (Green):** Indicates healthy retention metrics and stable accounts.
- **At Risk (Orange):** Signals a warning state requiring immediate investigation.
- **High Risk (Red):** Commands urgent attention for churn prevention.

The background system uses a subtle tonal shift between the sidebar (`#F8FAFC`) and the main dashboard area (`#FFFFFF`) to create clear spatial separation without the need for heavy borders.

## Typography

The design system utilizes **Inter** for all UI elements to ensure maximum legibility and a professional Fintech feel. The type scale is optimized for high-density data tables and dashboards.

- **Headlines:** Use tighter letter-spacing for a modern, "compacted" look in headers.
- **Data Mono:** For specific financial figures, account IDs, or percentages, a secondary monospaced font may be used to ensure numerical alignment in tables.
- **Labels:** Small caps are used for sidebar category headers and table column headers to provide clear distinction from interactive data points.

## Layout & Spacing

This design system employs a **Fixed-Fluid Hybrid Grid**. The sidebar remains fixed at 280px, while the main content area utilizes a 12-column fluid grid that adapts to the browser width.

- **Rhythm:** An 8px linear scale (8, 16, 24, 32, 40, 48, 64) governs all padding and margins.
- **Margins:** Large 32px outer margins on the main canvas provide "breathing room" for dense data visualizations.
- **Responsive Behavior:** 
  - **Desktop:** 12 columns, 24px gutters.
  - **Tablet:** 6 columns, 16px gutters, sidebar collapses to an icon-only rail.
  - **Mobile:** 4 columns, 16px gutters, sidebar moves to a bottom-sheet or hamburger menu.

## Elevation & Depth

To maintain a clean Fintech aesthetic, the design system avoids heavy shadows in favor of **Tonal Layers** and **Low-Contrast Outlines**.

- **Level 0 (Canvas):** The base background layer in White.
- **Level 1 (Cards):** Uses a 1px border (`#E2E8F0`) with no shadow. This keeps the interface feeling "flat" and data-centric.
- **Level 2 (Dropdowns/Modals):** Uses a soft, ambient shadow (Color: `#0F172A`, Opacity: 8%, Blur: 12px, Y-Offset: 4px) to indicate temporary overlay status.
- **Interactive States:** Hovering over a card or list item should result in a subtle background shift to `#F8FAFC` rather than an elevation increase.

## Shapes

The design system follows a **ROUND_EIGHT** philosophy, equating to a base radius of 8px (0.5rem).

- **Standard Elements:** Buttons, input fields, and small cards use the base 8px radius.
- **Large Containers:** Main dashboard widgets or large modal containers use 16px (1rem) for a more approachable feel.
- **Status Pills:** Use a full "pill" radius (999px) to distinguish them from interactive buttons.
- **Data Points:** Graph nodes and indicators remain sharp or use a minimal 2px radius for technical precision.

## Components

### Buttons
- **Primary:** Solid Dark Blue (`#0F172A`) with white text. 8px radius.
- **Secondary:** Outline Blue (`#0052FF`) with 1px border.
- **Ghost:** No border, blue text, used for secondary actions within tables.

### Risk Indicators (Chips)
- Status pills must use a high-contrast background (light tint) with a darker text version of the risk color (e.g., Light Red background with Dark Red text).
- Include a small 8px leading dot in the solid risk color for accessibility.

### Data Tables
- Header row uses `label-caps` typography with a light grey background (`#F8FAFC`).
- Row height is set to a comfortable 56px to ensure readability.
- Hover states should highlight the entire row in a soft blue tint.

### Health Score Gauge
- A custom component for this design system: A circular or semi-circular progress bar using the risk colors to visualize individual customer retention probability.

### Input Fields
- Subtle 1px borders in `#CBD5E1`.
- Focused state uses a 2px blue ring with 4px offset to ensure clear accessibility and high visibility.