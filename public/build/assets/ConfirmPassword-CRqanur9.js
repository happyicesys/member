import{T as m,c as n,o as d,w as t,a as e,u as a,Z as u,b as r,d as p,n as f,e as c}from"./app-lRfe2eoL.js";import{G as w}from"./GuestLayout-CFiid9Ag.js";import{_,a as b,b as x}from"./TextInput-4i1iPjPH.js";import{P as y}from"./PrimaryButton-HYmTgE53.js";import"./ResponsiveNavLink--mCFVlDD.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const g={class:"mt-4 flex justify-end"},$={__name:"ConfirmPassword",setup(P){const s=m({password:""}),i=()=>{s.post(route("password.confirm"),{onFinish:()=>s.reset()})};return(V,o)=>(d(),n(w,null,{default:t(()=>[e(a(u),{title:"Confirm Password"}),o[2]||(o[2]=r("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1)),r("form",{onSubmit:c(i,["prevent"])},[r("div",null,[e(_,{for:"password",value:"Password"}),e(b,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:a(s).password,"onUpdate:modelValue":o[0]||(o[0]=l=>a(s).password=l),required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),e(x,{class:"mt-2",message:a(s).errors.password},null,8,["message"])]),r("div",g,[e(y,{class:f(["ms-4",{"opacity-25":a(s).processing}]),disabled:a(s).processing},{default:t(()=>o[1]||(o[1]=[p(" Confirm ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}};export{$ as default};
