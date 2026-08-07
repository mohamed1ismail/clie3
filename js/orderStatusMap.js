/**
 * orderStatusMap.js
 * ─────────────────────────────────────────────────────────────────────────────
 * SINGLE SOURCE OF TRUTH for order status display in the admin dashboard.
 *
 * Backend enum values (orders.status):
 *   pending | confirmed | preparing | ready | completed | cancelled
 *
 * Admin-facing labels (Option B — 4-step linear flow):
 *   New → In Progress → Served → Completed
 *
 * Mapping logic:
 *   pending    → "New"         (order just arrived)
 *   confirmed  → "New"         (still awaiting kitchen — treat same as pending)
 *   preparing  → "In Progress" (kitchen is working on it)
 *   ready      → "Served"      (food is ready / delivered to table)
 *   completed  → "Completed"   (order fully done, paid/closed)
 *   cancelled  → "Cancelled"
 *
 * Status button flow (what the admin presses in the dashboard):
 *   "New"         → sends  pending    to PUT /api/orders/{id}/status
 *   "In Progress" → sends  preparing
 *   "Served"      → sends  ready
 *   "Completed"   → sends  completed
 *   "Cancelled"   → sends  cancelled
 *
 * USAGE EXAMPLES
 * ─────────────────────────────────────────────────────────────────────────────
 *   import { ORDER_STATUS_MAP, ADMIN_STATUS_ACTIONS, getStatusBadgeHTML } from './orderStatusMap.js';
 *
 *   // Display badge:
 *   const { label, color, bgClass, textClass } = ORDER_STATUS_MAP['preparing'];
 *   badge.textContent = label; // → "In Progress"
 *
 *   // Render badge HTML:
 *   cell.innerHTML = getStatusBadgeHTML(order.status);
 *
 *   // Build action buttons:
 *   ADMIN_STATUS_ACTIONS.forEach(({ label, value }) => {
 *     const btn = document.createElement('button');
 *     btn.textContent = label;
 *     btn.onclick = () => updateOrderStatus(orderId, value); // sends backend enum
 *   });
 * ─────────────────────────────────────────────────────────────────────────────
 */

/**
 * Maps every backend enum value → display metadata.
 *
 * Fields:
 *   label     — Human-readable label shown in the dashboard UI
 *   labelAr   — Arabic label
 *   color     — Semantic color name (used as a key for Tailwind / CSS classes)
 *   bgClass   — Tailwind background class for badge
 *   textClass — Tailwind text class for badge
 *   dotColor  — Inline dot colour (hex) for status indicators
 */
export const ORDER_STATUS_MAP = {
  pending: {
    label:     'New',
    labelAr:   'جديد',
    color:     'gray',
    bgClass:   'bg-gray-100 dark:bg-gray-700',
    textClass: 'text-gray-700 dark:text-gray-300',
    dotColor:  '#9CA3AF',
  },
  confirmed: {
    label:     'New',
    labelAr:   'جديد',
    color:     'gray',
    bgClass:   'bg-gray-100 dark:bg-gray-700',
    textClass: 'text-gray-700 dark:text-gray-300',
    dotColor:  '#9CA3AF',
  },
  preparing: {
    label:     'In Progress',
    labelAr:   'قيد التحضير',
    color:     'yellow',
    bgClass:   'bg-yellow-100 dark:bg-yellow-900/40',
    textClass: 'text-yellow-800 dark:text-yellow-300',
    dotColor:  '#F59E0B',
  },
  ready: {
    label:     'Served',
    labelAr:   'تم التقديم',
    color:     'blue',
    bgClass:   'bg-blue-100 dark:bg-blue-900/40',
    textClass: 'text-blue-800 dark:text-blue-300',
    dotColor:  '#3B82F6',
  },
  completed: {
    label:     'Completed',
    labelAr:   'مكتمل',
    color:     'green',
    bgClass:   'bg-green-100 dark:bg-green-900/40',
    textClass: 'text-green-800 dark:text-green-300',
    dotColor:  '#10B981',
  },
  cancelled: {
    label:     'Cancelled',
    labelAr:   'ملغي',
    color:     'red',
    bgClass:   'bg-red-100 dark:bg-red-900/40',
    textClass: 'text-red-800 dark:text-red-300',
    dotColor:  '#EF4444',
  },
};

/**
 * Fallback entry for any unknown status value.
 * Prevents crashes if the backend adds a new enum value without updating the map.
 */
const UNKNOWN_STATUS = {
  label:     'Unknown',
  labelAr:   'غير معروف',
  color:     'gray',
  bgClass:   'bg-gray-100 dark:bg-gray-700',
  textClass: 'text-gray-500',
  dotColor:  '#9CA3AF',
};

/**
 * Safe lookup — always returns a valid entry.
 *
 * @param {string} status — Raw backend enum value
 * @returns {object}
 */
export function getStatusMeta(status) {
  return ORDER_STATUS_MAP[status] ?? UNKNOWN_STATUS;
}

/**
 * Returns a ready-to-inject HTML badge string for an order status.
 * Uses inline styles so it works without a Tailwind build step.
 *
 * @param {string} status — Raw backend enum value
 * @param {'en'|'ar'} lang
 * @returns {string} HTML string
 */
export function getStatusBadgeHTML(status, lang = 'en') {
  const meta  = getStatusMeta(status);
  const label = lang === 'ar' ? meta.labelAr : meta.label;

  return `<span
    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold ${meta.bgClass} ${meta.textClass}"
  >
    <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:${meta.dotColor};"></span>
    ${label}
  </span>`;
}

// ─────────────────────────────────────────────────────────────────────────────
// ADMIN ACTION BUTTONS
// Four buttons the admin sees. Each maps a friendly label → backend enum value.
// Order reflects the linear flow: New → In Progress → Served → Completed.
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Action button definitions for the order management dashboard.
 * `value` is the exact string sent to PUT /api/orders/{id}/status.
 *
 * @type {Array<{label: string, labelAr: string, value: string, color: string}>}
 */
export const ADMIN_STATUS_ACTIONS = [
  { label: 'New',         labelAr: 'جديد',          value: 'pending',   color: 'gray'   },
  { label: 'In Progress', labelAr: 'قيد التحضير',   value: 'preparing', color: 'yellow' },
  { label: 'Served',      labelAr: 'تم التقديم',    value: 'ready',     color: 'blue'   },
  { label: 'Completed',   labelAr: 'مكتمل',         value: 'completed', color: 'green'  },
  { label: 'Cancelled',   labelAr: 'ملغي',          value: 'cancelled', color: 'red'    },
];

/**
 * Returns the admin action buttons as HTML <button> elements.
 * Pass a callback that receives the backend enum `value` when clicked.
 *
 * @param {string}   currentStatus — highlights the active button
 * @param {Function} onSelect      — called with (backendEnumValue: string)
 * @param {'en'|'ar'} lang
 * @returns {HTMLElement[]}
 */
export function buildStatusButtons(currentStatus, onSelect, lang = 'en') {
  return ADMIN_STATUS_ACTIONS.map(({ label, labelAr, value, color }) => {
    const btn    = document.createElement('button');
    const isActive = ORDER_STATUS_MAP[currentStatus]?.label === label
                  || currentStatus === value;

    btn.type      = 'button';
    btn.textContent = lang === 'ar' ? labelAr : label;
    btn.dataset.statusValue = value; // raw backend value, safe to read from DOM

    // Base classes
    btn.className = [
      'px-3 py-1.5 rounded-md text-sm font-medium transition-all duration-200',
      'border focus:outline-none focus:ring-2 focus:ring-offset-1',
      isActive
        ? `bg-${color}-500 text-white border-${color}-500 ring-${color}-300`
        : `bg-transparent text-${color}-700 border-${color}-300 hover:bg-${color}-50`,
    ].join(' ');

    btn.addEventListener('click', () => onSelect(value));
    return btn;
  });
}
