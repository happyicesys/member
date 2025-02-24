import{r as p,T as P,f as S,l as i,V as k,c as C,w as B,o as _,a as A,b as a,h as m,j as D,n as f,u as I,t as c,F as M,W as h}from"./app-Do09xm5B.js";import{A as H}from"./AuthenticatedLayout-BPwUcj88.js";import{_ as U}from"./_plugin-vue_export-helper-DlAUqK2U.js";/* empty css                                                                        */import"./ResponsiveNavLink-CMwAAZJ9.js";const $={class:"py-10 bg-gray-50"},j={class:"mx-auto max-w-3xl px-6"},F={class:"space-y-4"},L=["onClick"],N={class:"flex-1 pr-4"},V={class:"text-xl font-bold text-gray-800"},E={class:"text-gray-600 whitespace-pre-line"},O={class:"mt-2 text-red-400 font-semibold"},q={class:"mt-6 text-center"},z=["disabled"],T={__name:"Index",props:{plans:[Array,Object],planItemUser:Object,needsPaymentMethod:Boolean,userHasAnyPaymentMethod:Boolean},setup(g){const r=g;p("/billing-portal");const o=p([]),u=p([]),t=P({plan_id:""});S(()=>{o.value=r.plans.data,u.value=r.planItemUser.data,t.plan_id=u.value.plan_id});const b=i(()=>o.value.find(e=>e.id===t.plan_id)),s=i(()=>o.value.find(e=>e.id===u.value.plan_id));i(()=>r.needsPaymentMethod&&!r.userHasAnyPaymentMethod);const d=i(()=>s.value?t.plan_id===s.value.id?"Subscribed":b.value.level>s.value.level?"Upgrade Plan":b.value.level<s.value.level?"Downgrade Plan":"Subscribe":"Subscribe"),v=i(()=>{var e;return!t.plan_id||t.plan_id===((e=s.value)==null?void 0:e.id)}),y=()=>{if(!t.plan_id){alert("Please select a plan before proceeding.");return}let e=o.value.find(l=>l.id===t.plan_id);if(e.level<s.value.level){h.visit(`/plan/retention?plan_id=${t.plan_id}`);return}if(e.is_required_payment&&!r.userHasAnyPaymentMethod){h.get(`/plan/payment?plan_id=${t.plan_id}`);return}t.post("/plan/subscribe",{preserveScroll:!0,onSuccess:()=>alert("Subscription successful!"),onError:l=>console.error(l)})},x=e=>{e.is_available&&(t.plan_id=e.id)};return(e,l)=>{const w=k("Head");return _(),C(H,null,{default:B(()=>[A(w,{title:"Plan"}),a("div",$,[a("div",j,[l[0]||(l[0]=a("h2",{class:"text-3xl font-bold text-red-400 mb-6 font-heading text-center"},"Choose Your Plan",-1)),a("div",null,[a("div",F,[(_(!0),m(M,null,D(o.value,n=>(_(),m("div",{key:n.id,class:f(["p-6 bg-white rounded-lg shadow-md flex items-center justify-between border-2 cursor-pointer transition duration-200",I(t).plan_id===n.id?"border-red-400 bg-red-50":"border-gray-200",n.is_available?"":"opacity-50 cursor-not-allowed"]),onClick:W=>x(n)},[a("div",N,[a("h3",V,c(n.name),1),a("p",E,c(n.description),1),a("p",O,c(n.price>0?`$${n.price.toFixed(2)} per month`:"Free"),1)])],10,L))),128))]),a("div",q,[a("button",{onClick:y,class:f(["text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-200",{"bg-green-400 hover:bg-green-500":d.value==="Subscribe","bg-blue-400 hover:bg-blue-500":d.value.includes("Upgrade"),"bg-yellow-400 hover:bg-yellow-500":d.value.includes("Downgrade"),"bg-gray-400 cursor-not-allowed":v.value}]),disabled:v.value},c(d.value),11,z)])])])])]),_:1})}}},R=U(T,[["__scopeId","data-v-bef0841a"]]);export{R as default};
