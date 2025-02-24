import{A as p}from"./AuthenticatedLayout-BPwUcj88.js";import{r as m,f as y,l as v,c as f,w as h,o as a,a as b,u as w,Z as k,b as t,t as e,h as r,j as u,F as x,k as F}from"./app-Do09xm5B.js";import{_ as D}from"./_plugin-vue_export-helper-DlAUqK2U.js";/* empty css                                                                        */import"./ResponsiveNavLink-CMwAAZJ9.js";const S={class:"py-4 bg-gray-100"},j={class:"mx-auto px-6 sm:px-8 lg:px-12"},A={class:"bg-white py-12 sm:py-16 mb-10 shadow rounded-lg w-fit mx-auto"},C={class:"mx-auto px-12 lg:px-10 flex items-center space-x-2"},L={class:"mx-auto flex max-w-md flex-col"},B={class:"text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl"},H={role:"list",class:"divide-y divide-gray-300 bg-white shadow rounded-lg"},I={class:"px-4 sm:px-6 lg:px-8"},N={class:"flex items-start justify-between"},T={class:"flex-1"},V={class:"text-lg font-semibold text-gray-700 flex space-x-2 items-center"},O={class:"text-xs text-gray-500"},P={class:"mt-1 text-sm text-gray-600"},E={class:"text-sm text-gray-800"},M={class:"mt-4"},Y={class:"mt-2 space-y-2"},Z=["src"],q={class:"text-sm font-medium text-gray-900"},z={key:0},G={__name:"History",props:{transactedCountry:[Array,Object],vendTransactions:[Array,Object]},setup(_){const c=_,n=m([]),i=m([]);y(()=>{n.value=c.transactedCountry.data,i.value=c.vendTransactions.data});const g=v(()=>i.value.reduce((d,s)=>d+s.total_promo_amount,0));return(d,s)=>(a(),f(p,null,{default:h(()=>[b(w(k),{title:"History"}),t("div",S,[t("div",j,[t("div",A,[t("div",C,[s[1]||(s[1]=t("section",{class:"text-white rounded"},[t("img",{src:"/images/icon.png",alt:"Vion Icon",class:"w-36 rounded mx-auto"})],-1)),t("div",L,[s[0]||(s[0]=t("dt",{class:"text-base/7 text-gray-700"},"You have saved",-1)),t("dd",B,e(n.value.currency_symbol)+" "+e(g.value.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1)])])]),s[3]||(s[3]=t("h1",{class:"text-2xl font-bold text-red-700 mb-6 px-2"},"Purchase History",-1)),t("ul",H,[(a(!0),r(x,null,u(i.value,o=>(a(),r("li",{key:o.id,class:"relative py-5 hover:bg-gray-50"},[t("div",I,[t("div",N,[t("div",T,[t("h2",V,[t("span",null,e(o.customer_name),1),t("small",O,"("+e(o.datetime_for_humans)+")",1)]),t("p",P," Amount: "+e(n.value.currency_symbol)+" "+e(o.total_amount.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),t("p",E," Saved: "+e(n.value.currency_symbol)+" "+e(o.total_promo_amount.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),t("div",M,[t("ul",Y,[(a(!0),r(x,null,u(o.vendTransactionItems,l=>(a(),r("li",{key:l.id,class:"flex items-center gap-x-4"},[t("img",{src:l.product_thumbnail_url,alt:"Product Image",class:"h-20 w-20 rounded-lg border bg-gray-200"},null,8,Z),t("div",null,[t("p",q,e(l.product_name),1)])]))),128))])])])])])]))),128)),!i.value||!i.value.length?(a(),r("li",z,s[2]||(s[2]=[t("div",{class:"flex items-center justify-center py-4"},[t("p",{class:"text-sm text-gray-600"},"No records found")],-1)]))):F("",!0)])])])]),_:1}))}},W=D(G,[["__scopeId","data-v-ce90e4c8"]]);export{W as default};
