export const __ = function(name, domain = ''){
    let textdomain = import.meta.env.VITE_TEXT_DOMAIN || domain
    return import.meta.env.DEV ? name : wp.i18n.__(name, textdomain)
}