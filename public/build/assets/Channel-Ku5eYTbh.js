import{_ as w}from"./Modal-Dm7hVtZn.js";import{_ as C}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{r as m,f as k,c as q,a as S,w as f,K as B,o as n,b as t,d as M,h as a,t as r,j as d,i as N,n as _,F as O}from"./app-DrZROH6k.js";const F={class:"flex flex-col md:flex-row space-x-3"},I={class:"text-gray-600"},V={key:0},$={key:0},j={class:"flex flex-col"},A={class:"overflow-x-auto"},D={class:"inline-block min-w-full py-2 align-middle"},L={class:"overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg"},P={class:"min-w-full divide-y divide-gray-300"},T={class:"bg-white"},z=["onClick"],E={class:"px-4 py-3 text-center"},K={class:"px-4 py-3"},U=["src"],G={class:"px-4 py-3 text-center"},H={class:"px-4 py-3 text-center"},J={__name:"Channel",props:{vend:Object,showModal:Boolean},emits:["modalClose"],setup(l,{emit:Q}){const y=l,c=m([]),h=m(null);k(()=>{c.value=y.vend.vendChannels.map(s=>({...s,product:s.product||{}}))});function v(s){h.value=s}function b(s){var o;return s.qty>=3?"Available":s.qty>=1&&s.qty<3?"Selling Out Fast":s.qty==0||(o=s.vend_channel_error_logs)!=null&&o.length?"Sold Out":"Unknown"}return(s,o)=>(n(),q(B,{to:"body"},[S(w,{open:l.showModal,onModalClose:o[0]||(o[0]=e=>s.$emit("modalClose"))},{header:f(()=>{var e;return[t("div",F,[t("span",I,[o[1]||(o[1]=M(" Machine ")),l.vend.code?(n(),a("span",V,"ID# "+r(l.vend.code),1)):d("",!0)]),l.vend.customer?(n(),a("span",$,r((e=l.vend.customer)==null?void 0:e.name),1)):d("",!0)])]}),default:f(()=>[t("div",j,[t("div",A,[t("div",D,[t("div",L,[t("table",P,[o[2]||(o[2]=t("thead",{class:"bg-gray-50"},[t("tr",null,[t("th",{scope:"col",class:"px-4 py-3 text-xs font-semibold text-gray-900 text-center"},"Channel#"),t("th",{scope:"col",class:"px-4 py-3 text-xs font-semibold text-gray-900 text-center"},"Image"),t("th",{scope:"col",class:"px-4 py-3 text-xs font-semibold text-gray-900 text-center"},"Product"),t("th",{scope:"col",class:"px-4 py-3 text-xs font-semibold text-gray-900 text-center"},"Status")])],-1)),t("tbody",T,[(n(!0),a(O,null,N(c.value,(e,i)=>{var u,x,p,g;return n(),a("tr",{key:e.id,class:_([{"bg-gray-50":i%2!==0},"cursor-pointer hover:bg-gray-200"]),onClick:R=>v(i)},[t("td",E,r(e.code),1),t("td",K,[(x=(u=e.product)==null?void 0:u.thumbnail)!=null&&x.full_url?(n(),a("img",{key:0,src:e.product.thumbnail.full_url,alt:"Product Image",class:"w-20 h-20 rounded-full mx-auto"},null,8,U)):d("",!0)]),t("td",G,r(((p=e.product)==null?void 0:p.name)||"N/A"),1),t("td",H,[t("span",{class:_([{"bg-green-200 text-green-800":e.qty>=3,"bg-orange-200 text-orange-800":e.qty>=1&&e.qty<3,"bg-red-200 text-red-800":e.qty==0||((g=e.vend_channel_error_logs)==null?void 0:g.length)},"px-2 py-1 rounded-full text-xs font-bold"])},r(b(e)),3)])],10,z)}),128))])])])])]),o[3]||(o[3]=t("div",{class:"mt-4 flex justify-around text-sm"},[t("div",{class:"flex items-center space-x-2"},[t("span",{class:"w-4 h-4 bg-green-200 rounded-full"}),t("span",null,"Available (>= 3)")]),t("div",{class:"flex items-center space-x-2"},[t("span",{class:"w-4 h-4 bg-orange-200 rounded-full"}),t("span",null,"Selling Out Fast (< 3)")]),t("div",{class:"flex items-center space-x-2"},[t("span",{class:"w-4 h-4 bg-red-200 rounded-full"}),t("span",null,"Sold Out")])],-1))])]),_:1},8,["open"])]))}},Z=C(J,[["__scopeId","data-v-d7c4f19a"]]);export{Z as default};
