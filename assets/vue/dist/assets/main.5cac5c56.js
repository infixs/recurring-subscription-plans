import{N as e,a as s,r,o as t,c as n,b as o,w as a,d as i,e as d,f as u,g as l,p as c}from"./vendor.bb9f3b27.js";const p={},m=function(e,s){return s&&0!==s.length?Promise.all(s.map((e=>{if((e=`/wp-content/plugins/recurring-subscription-plans/assets/vue/dist/${e}`)in p)return;p[e]=!0;const s=e.endsWith(".css"),r=s?'[rel="stylesheet"]':"";if(document.querySelector(`link[href="${e}"]${r}`))return;const t=document.createElement("link");return t.rel=s?"stylesheet":"modulepreload",s||(t.as="script",t.crossOrigin=""),t.href=e,document.head.appendChild(t),s?new Promise(((e,s)=>{t.addEventListener("load",e),t.addEventListener("error",s)})):void 0}))).then((()=>e())):e()};var f=(e,s)=>{for(const[r,t]of s)e[r]=t;return e};const v={class:"wrap"};var _=f({components:{NMessageProvider:e,NDialogProvider:s}},[["render",function(e,s,i,d,u,l){const c=r("router-view"),p=r("n-dialog-provider"),m=r("n-message-provider");return t(),n("div",v,[o(m,null,{default:a((()=>[o(p,null,{default:a((()=>[o(c)])),_:1})])),_:1})])}]]);i.defaults.baseURL="/wp-json/rsp/v1/";const h=[{path:"/",component:()=>m((()=>import("./Main.502ab2d7.js")),["assets/Main.502ab2d7.js","assets/Main.d72600e2.css","assets/vendor.bb9f3b27.js"])},{path:"/about",name:"about",component:()=>m((()=>import("./About.83dffc14.js")),["assets/About.83dffc14.js","assets/vendor.bb9f3b27.js"])}],b=d({history:u(),routes:h});l(_).use(c,i).use(b).mount("#app");export{f as _};