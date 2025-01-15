import{o as c,h as f,C as _,r as m,T as x,b as t,a as o,w as d,y as b,d as u,u as n,R as v,n as h}from"./app-DQQ2TAO6.js";import{_ as k}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{_ as $,a as C,b as D}from"./TextInput-92kXjJxM.js";import{_ as B}from"./Modal-Ba0d31cn.js";const V={},S={class:"inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700"};function U(a,r){return c(),f("button",S,[_(a.$slots,"default")])}const y=k(V,[["render",U]]),A=["type"],E={__name:"SecondaryButton",props:{type:{type:String,default:"button"}},setup(a){return(r,l)=>(c(),f("button",{type:a.type,class:"inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25"},[_(r.$slots,"default")],8,A))}},N={class:"space-y-6"},P={class:"p-6"},T={class:"mt-6"},F={class:"mt-6 flex justify-end"},M={__name:"DeleteUserForm",setup(a){const r=m(!1),l=m(null),s=x({password:""}),g=()=>{r.value=!0,b(()=>l.value.focus())},p=()=>{s.delete(route("profile.destroy"),{preserveScroll:!0,onSuccess:()=>i(),onError:()=>l.value.focus(),onFinish:()=>s.reset()})},i=()=>{r.value=!1,s.clearErrors(),s.reset()};return(I,e)=>(c(),f("section",N,[e[6]||(e[6]=t("header",null,[t("h2",{class:"text-lg font-medium text-gray-900"}," Delete Account "),t("p",{class:"mt-1 text-sm text-gray-600"}," Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. ")],-1)),o(y,{onClick:g},{default:d(()=>e[1]||(e[1]=[u("Delete Account")])),_:1}),o(B,{show:r.value,onClose:i},{default:d(()=>[t("div",P,[e[4]||(e[4]=t("h2",{class:"text-lg font-medium text-gray-900"}," Are you sure you want to delete your account? ",-1)),e[5]||(e[5]=t("p",{class:"mt-1 text-sm text-gray-600"}," Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account. ",-1)),t("div",T,[o($,{for:"password",value:"Password",class:"sr-only"}),o(C,{id:"password",ref_key:"passwordInput",ref:l,modelValue:n(s).password,"onUpdate:modelValue":e[0]||(e[0]=w=>n(s).password=w),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",onKeyup:v(p,["enter"])},null,8,["modelValue"]),o(D,{message:n(s).errors.password,class:"mt-2"},null,8,["message"])]),t("div",F,[o(E,{onClick:i},{default:d(()=>e[2]||(e[2]=[u(" Cancel ")])),_:1}),o(y,{class:h(["ms-3",{"opacity-25":n(s).processing}]),disabled:n(s).processing,onClick:p},{default:d(()=>e[3]||(e[3]=[u(" Delete Account ")])),_:1},8,["class","disabled"])])])]),_:1},8,["show"])]))}};export{M as default};
