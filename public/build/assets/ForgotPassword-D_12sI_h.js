import{T as u,c as d,w as r,o as i,a,u as t,Z as c,b as o,h as p,t as f,j as w,d as y,n as g,e as _}from"./app-CrxRQIap.js";import{G as b}from"./GuestLayout-6di38cwi.js";import{_ as x,a as k,b as V}from"./TextInput-k5JSGM1h.js";import{P as v}from"./PrimaryButton-De8gtLar.js";import"./ResponsiveNavLink-CD1G_r1c.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const B={key:0,class:"mb-4 text-sm font-medium text-green-600"},N={class:"mt-4 flex items-center justify-end"},j={__name:"ForgotPassword",props:{status:{type:String}},setup(l){const e=u({email:""}),m=()=>{e.post(route("password.email"))};return(P,s)=>(i(),d(b,null,{default:r(()=>[a(t(c),{title:"Forgot Password"}),s[2]||(s[2]=o("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1)),l.status?(i(),p("div",B,f(l.status),1)):w("",!0),o("form",{onSubmit:_(m,["prevent"])},[o("div",null,[a(x,{for:"email",value:"Email"}),a(k,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:t(e).email,"onUpdate:modelValue":s[0]||(s[0]=n=>t(e).email=n),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(V,{class:"mt-2",message:t(e).errors.email},null,8,["message"])]),o("div",N,[a(v,{class:g({"opacity-25":t(e).processing}),disabled:t(e).processing},{default:r(()=>s[1]||(s[1]=[y(" Email Password Reset Link ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}};export{j as default};
