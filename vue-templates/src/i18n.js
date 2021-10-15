export const __ = function(name, domain = 'recurring-subscription-plans'){
    return import.meta.env.DEV ? name : wp.i18n.__(name, domain)
}