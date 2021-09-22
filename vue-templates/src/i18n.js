export const __ = function(name, domain = 'recurring-subscription-plans'){

    console.log(import.meta.env)
    console.log(name, domain)
    console.log(import.meta.env.DEV ? 'develpment' : wp.i18n )

    return import.meta.env.DEV ? name : wp.i18n.__(name, domain)
}