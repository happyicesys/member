import{_ as q}from"./Modal-Cfktic7J.js";import{_ as N}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{r as f,f as M,c as B,a as I,w as h,K as S,o as d,b as t,d as $,h as n,t as l,j as x,i as v,n as p,F as b}from"./app-BWTMTRlB.js";const L={class:"flex flex-col space-y-3"},V={class:"flex flex-col md:flex-row md:space-x-3 space-y-1"},j={class:"text-gray-600 text-sm"},P={key:0},A={key:0},D={class:"text-sm text-gray-500"},F={class:"flex flex-col"},O={class:"hidden md:block overflow-x-auto"},T={class:"inline-block min-w-full py-2 align-middle"},z={class:"overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg"},E={class:"min-w-full divide-y divide-gray-300"},K={class:"bg-white"},U=["onClick"],G={class:"px-4 py-3 text-center"},H={class:"px-4 py-3"},J=["src"],Q={class:"px-4 py-3 text-center"},R={class:"px-4 py-3 text-center"},W={class:"md:hidden space-y-2"},X=["onClick"],Y={class:"flex items-center justify-between"},Z={class:"text-gray-600 font-semibold"},tt={class:"flex items-center space-x-4"},et=["src"],st={class:"flex-1"},ot={class:"text-gray-700 font-medium"},dt={__name:"Channel",props:{showModal:Boolean,timingNow:String,vend:Object},emits:["modalClose"],setup(r,{emit:lt}){const w=r,g=f([]),k=f(null);M(()=>{g.value=w.vend.vendChannels.map(s=>({...s,product:s.product||{}}))});function m(s){k.value=s}function y(s){var o;return s.qty>=3?"More than 3 pcs":s.qty>=1&&s.qty<3?"Less than 3 pcs":s.qty==0||(o=s.vend_channel_error_logs)!=null&&o.length?"Sold Out":"Unknown"}return(s,o)=>(d(),B(S,{to:"body"},[I(q,{open:r.showModal,onModalClose:o[0]||(o[0]=e=>s.$emit("modalClose"))},{header:h(()=>{var e;return[t("div",L,[t("div",V,[t("span",j,[o[1]||(o[1]=$(" Machine ")),r.vend.code?(d(),n("span",P,"ID "+l(r.vend.code),1)):x("",!0)]),r.vend.customer?(d(),n("span",A,l((e=r.vend.customer)==null?void 0:e.name),1)):x("",!0)]),t("span",D," Loaded at "+l(r.timingNow),1)])]}),default:h(()=>[t("div",F,[t("div",O,[t("div",T,[t("div",z,[t("table",E,[o[2]||(o[2]=t("thead",{class:"bg-gray-50"},[t("tr",null,[t("th",{scope:"col",class:"px-4 py-3 text-xs font-semibold text-gray-900 text-center"},"Channel#"),t("th",{scope:"col",class:"px-4 py-3 text-xs font-semibold text-gray-900 text-center"},"Image"),t("th",{scope:"col",class:"px-4 py-3 text-xs font-semibold text-gray-900 text-center"},"Product"),t("th",{scope:"col",class:"px-4 py-3 text-xs font-semibold text-gray-900 text-center"},"Status")])],-1)),t("tbody",K,[(d(!0),n(b,null,v(g.value,(e,_)=>{var a,c,i,u;return d(),n("tr",{key:e.id,class:p([{"bg-gray-50":_%2!==0},"cursor-pointer hover:bg-gray-200"]),onClick:C=>m(_)},[t("td",G,l(e.code),1),t("td",H,[(c=(a=e.product)==null?void 0:a.thumbnail)!=null&&c.full_url?(d(),n("img",{key:0,src:e.product.thumbnail.full_url,alt:"Product Image",class:"w-20 h-20 rounded-full mx-auto"},null,8,J)):x("",!0)]),t("td",Q,l(((i=e.product)==null?void 0:i.name)||"N/A"),1),t("td",R,[t("span",{class:p([{"bg-green-200 text-green-800":e.qty>=3,"bg-orange-200 text-orange-800":e.qty>=1&&e.qty<3,"bg-red-200 text-red-800":e.qty==0||((u=e.vend_channel_error_logs)==null?void 0:u.length)},"px-2 py-1 rounded-full text-xs font-bold"])},l(y(e)),3)])],10,U)}),128))])])])])]),t("div",W,[(d(!0),n(b,null,v(g.value,(e,_)=>{var a,c,i,u;return d(),n("div",{key:e.id,class:"p-4 bg-white shadow rounded-lg space-y-2",onClick:C=>m(_)},[t("div",Y,[t("span",Z,"Channel "+l(e.code),1),t("span",{class:p([{"bg-green-200 text-green-800":e.qty>=3,"bg-orange-200 text-orange-800":e.qty>=1&&e.qty<3,"bg-red-200 text-red-800":e.qty==0||((a=e.vend_channel_error_logs)==null?void 0:a.length)},"px-2 py-1 rounded-full text-xs font-bold"])},l(y(e)),3)]),t("div",tt,[(i=(c=e.product)==null?void 0:c.thumbnail)!=null&&i.full_url?(d(),n("img",{key:0,src:e.product.thumbnail.full_url,alt:"Product Image",class:"w-16 h-16 rounded-full"},null,8,et)):x("",!0),t("div",st,[t("p",ot,l(((u=e.product)==null?void 0:u.name)||"N/A"),1)])])],8,X)}),128))])])]),_:1},8,["open"])]))}},ct=N(dt,[["__scopeId","data-v-55396265"]]);export{ct as default};
