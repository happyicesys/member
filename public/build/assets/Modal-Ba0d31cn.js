import{o as Xe,h as gt,b as B,_ as yt,$ as P,a0 as x,r as g,l as h,a1 as wt,M as S,F as Qe,q as A,a2 as N,f as $,z as M,A as Z,a3 as bt,K as Et,p as St,a4 as Tt,y as Lt,n as $t,c as Ft,w as X,a as Q,u as W,e as Ot,C as We}from"./app-DQQ2TAO6.js";function Pt(e,t){return Xe(),gt("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true","data-slot":"icon"},[B("path",{d:"M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"})])}function ke(e){typeof queueMicrotask=="function"?queueMicrotask(e):Promise.resolve().then(e).catch(t=>setTimeout(()=>{throw t}))}function re(){let e=[],t={addEventListener(n,l,r,a){return n.addEventListener(l,r,a),t.add(()=>n.removeEventListener(l,r,a))},requestAnimationFrame(...n){let l=requestAnimationFrame(...n);t.add(()=>cancelAnimationFrame(l))},nextFrame(...n){t.requestAnimationFrame(()=>{t.requestAnimationFrame(...n)})},setTimeout(...n){let l=setTimeout(...n);t.add(()=>clearTimeout(l))},microTask(...n){let l={current:!0};return ke(()=>{l.current&&n[0]()}),t.add(()=>{l.current=!1})},style(n,l,r){let a=n.style.getPropertyValue(l);return Object.assign(n.style,{[l]:r}),this.add(()=>{Object.assign(n.style,{[l]:a})})},group(n){let l=re();return n(l),this.add(()=>l.dispose())},add(n){return e.push(n),()=>{let l=e.indexOf(n);if(l>=0)for(let r of e.splice(l,1))r()}},dispose(){for(let n of e.splice(0))n()}};return t}var Ve;let xt=Symbol("headlessui.useid"),At=0;const ye=(Ve=yt)!=null?Ve:function(){return P(xt,()=>`${++At}`)()};function E(e){var t;if(e==null||e.value==null)return null;let n=(t=e.value.$el)!=null?t:e.value;return n instanceof Node?n:null}function k(e,t,...n){if(e in t){let r=t[e];return typeof r=="function"?r(...n):r}let l=new Error(`Tried to handle "${e}" but there is no handler defined. Only defined handlers are: ${Object.keys(t).map(r=>`"${r}"`).join(", ")}.`);throw Error.captureStackTrace&&Error.captureStackTrace(l,k),l}var Ct=Object.defineProperty,Dt=(e,t,n)=>t in e?Ct(e,t,{enumerable:!0,configurable:!0,writable:!0,value:n}):e[t]=n,qe=(e,t,n)=>(Dt(e,typeof t!="symbol"?t+"":t,n),n);let Nt=class{constructor(){qe(this,"current",this.detect()),qe(this,"currentId",0)}set(t){this.current!==t&&(this.currentId=0,this.current=t)}reset(){this.set(this.detect())}nextId(){return++this.currentId}get isServer(){return this.current==="server"}get isClient(){return this.current==="client"}detect(){return typeof window>"u"||typeof document>"u"?"server":"client"}},ae=new Nt;function J(e){if(ae.isServer)return null;if(e instanceof Node)return e.ownerDocument;if(e!=null&&e.hasOwnProperty("value")){let t=E(e);if(t)return t.ownerDocument}return document}let Oe=["[contentEditable=true]","[tabindex]","a[href]","area[href]","button:not([disabled])","iframe","input:not([disabled])","select:not([disabled])","textarea:not([disabled])"].map(e=>`${e}:not([tabindex='-1'])`).join(",");var I=(e=>(e[e.First=1]="First",e[e.Previous=2]="Previous",e[e.Next=4]="Next",e[e.Last=8]="Last",e[e.WrapAround=16]="WrapAround",e[e.NoScroll=32]="NoScroll",e))(I||{}),Ze=(e=>(e[e.Error=0]="Error",e[e.Overflow=1]="Overflow",e[e.Success=2]="Success",e[e.Underflow=3]="Underflow",e))(Ze||{}),Mt=(e=>(e[e.Previous=-1]="Previous",e[e.Next=1]="Next",e))(Mt||{});function kt(e=document.body){return e==null?[]:Array.from(e.querySelectorAll(Oe)).sort((t,n)=>Math.sign((t.tabIndex||Number.MAX_SAFE_INTEGER)-(n.tabIndex||Number.MAX_SAFE_INTEGER)))}var Je=(e=>(e[e.Strict=0]="Strict",e[e.Loose=1]="Loose",e))(Je||{});function Rt(e,t=0){var n;return e===((n=J(e))==null?void 0:n.body)?!1:k(t,{0(){return e.matches(Oe)},1(){let l=e;for(;l!==null;){if(l.matches(Oe))return!0;l=l.parentElement}return!1}})}var jt=(e=>(e[e.Keyboard=0]="Keyboard",e[e.Mouse=1]="Mouse",e))(jt||{});typeof window<"u"&&typeof document<"u"&&(document.addEventListener("keydown",e=>{e.metaKey||e.altKey||e.ctrlKey||(document.documentElement.dataset.headlessuiFocusVisible="")},!0),document.addEventListener("click",e=>{e.detail===1?delete document.documentElement.dataset.headlessuiFocusVisible:e.detail===0&&(document.documentElement.dataset.headlessuiFocusVisible="")},!0));function K(e){e==null||e.focus({preventScroll:!0})}let Ht=["textarea","input"].join(",");function Bt(e){var t,n;return(n=(t=e==null?void 0:e.matches)==null?void 0:t.call(e,Ht))!=null?n:!1}function It(e,t=n=>n){return e.slice().sort((n,l)=>{let r=t(n),a=t(l);if(r===null||a===null)return 0;let i=r.compareDocumentPosition(a);return i&Node.DOCUMENT_POSITION_FOLLOWING?-1:i&Node.DOCUMENT_POSITION_PRECEDING?1:0})}function me(e,t,{sorted:n=!0,relativeTo:l=null,skipElements:r=[]}={}){var a;let i=(a=Array.isArray(e)?e.length>0?e[0].ownerDocument:document:e==null?void 0:e.ownerDocument)!=null?a:document,o=Array.isArray(e)?n?It(e):e:kt(e);r.length>0&&o.length>1&&(o=o.filter(f=>!r.includes(f))),l=l??i.activeElement;let u=(()=>{if(t&5)return 1;if(t&10)return-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),s=(()=>{if(t&1)return 0;if(t&2)return Math.max(0,o.indexOf(l))-1;if(t&4)return Math.max(0,o.indexOf(l))+1;if(t&8)return o.length-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),d=t&32?{preventScroll:!0}:{},m=0,c=o.length,v;do{if(m>=c||m+c<=0)return 0;let f=s+m;if(t&16)f=(f+c)%c;else{if(f<0)return 3;if(f>=c)return 1}v=o[f],v==null||v.focus(d),m+=u}while(v!==i.activeElement);return t&6&&Bt(v)&&v.select(),2}function et(){return/iPhone/gi.test(window.navigator.platform)||/Mac/gi.test(window.navigator.platform)&&window.navigator.maxTouchPoints>0}function _t(){return/Android/gi.test(window.navigator.userAgent)}function Ut(){return et()||_t()}function fe(e,t,n){ae.isServer||x(l=>{document.addEventListener(e,t,n),l(()=>document.removeEventListener(e,t,n))})}function tt(e,t,n){ae.isServer||x(l=>{window.addEventListener(e,t,n),l(()=>window.removeEventListener(e,t,n))})}function Wt(e,t,n=h(()=>!0)){function l(a,i){if(!n.value||a.defaultPrevented)return;let o=i(a);if(o===null||!o.getRootNode().contains(o))return;let u=function s(d){return typeof d=="function"?s(d()):Array.isArray(d)||d instanceof Set?d:[d]}(e);for(let s of u){if(s===null)continue;let d=s instanceof HTMLElement?s:E(s);if(d!=null&&d.contains(o)||a.composed&&a.composedPath().includes(d))return}return!Rt(o,Je.Loose)&&o.tabIndex!==-1&&a.preventDefault(),t(a,o)}let r=g(null);fe("pointerdown",a=>{var i,o;n.value&&(r.value=((o=(i=a.composedPath)==null?void 0:i.call(a))==null?void 0:o[0])||a.target)},!0),fe("mousedown",a=>{var i,o;n.value&&(r.value=((o=(i=a.composedPath)==null?void 0:i.call(a))==null?void 0:o[0])||a.target)},!0),fe("click",a=>{Ut()||r.value&&(l(a,()=>r.value),r.value=null)},!0),fe("touchend",a=>l(a,()=>a.target instanceof HTMLElement?a.target:null),!0),tt("blur",a=>l(a,()=>window.document.activeElement instanceof HTMLIFrameElement?window.document.activeElement:null),!0)}var he=(e=>(e[e.None=0]="None",e[e.RenderStrategy=1]="RenderStrategy",e[e.Static=2]="Static",e))(he||{}),_=(e=>(e[e.Unmount=0]="Unmount",e[e.Hidden=1]="Hidden",e))(_||{});function R({visible:e=!0,features:t=0,ourProps:n,theirProps:l,...r}){var a;let i=lt(l,n),o=Object.assign(r,{props:i});if(e||t&2&&i.static)return Le(o);if(t&1){let u=(a=i.unmount)==null||a?0:1;return k(u,{0(){return null},1(){return Le({...r,props:{...i,hidden:!0,style:{display:"none"}}})}})}return Le(o)}function Le({props:e,attrs:t,slots:n,slot:l,name:r}){var a,i;let{as:o,...u}=rt(e,["unmount","static"]),s=(a=n.default)==null?void 0:a.call(n,l),d={};if(l){let m=!1,c=[];for(let[v,f]of Object.entries(l))typeof f=="boolean"&&(m=!0),f===!0&&c.push(v);m&&(d["data-headlessui-state"]=c.join(" "))}if(o==="template"){if(s=nt(s??[]),Object.keys(u).length>0||Object.keys(t).length>0){let[m,...c]=s??[];if(!Vt(m)||c.length>0)throw new Error(['Passing props on "template"!',"",`The current component <${r} /> is rendering a "template".`,"However we need to passthrough the following props:",Object.keys(u).concat(Object.keys(t)).map(p=>p.trim()).filter((p,w,C)=>C.indexOf(p)===w).sort((p,w)=>p.localeCompare(w)).map(p=>`  - ${p}`).join(`
`),"","You can apply a few solutions:",['Add an `as="..."` prop, to ensure that we render an actual element instead of a "template".',"Render a single element as the child so that we can forward the props onto that element."].map(p=>`  - ${p}`).join(`
`)].join(`
`));let v=lt((i=m.props)!=null?i:{},u,d),f=wt(m,v,!0);for(let p in v)p.startsWith("on")&&(f.props||(f.props={}),f.props[p]=v[p]);return f}return Array.isArray(s)&&s.length===1?s[0]:s}return S(o,Object.assign({},u,d),{default:()=>s})}function nt(e){return e.flatMap(t=>t.type===Qe?nt(t.children):[t])}function lt(...e){if(e.length===0)return{};if(e.length===1)return e[0];let t={},n={};for(let l of e)for(let r in l)r.startsWith("on")&&typeof l[r]=="function"?(n[r]!=null||(n[r]=[]),n[r].push(l[r])):t[r]=l[r];if(t.disabled||t["aria-disabled"])return Object.assign(t,Object.fromEntries(Object.keys(n).map(l=>[l,void 0])));for(let l in n)Object.assign(t,{[l](r,...a){let i=n[l];for(let o of i){if(r instanceof Event&&r.defaultPrevented)return;o(r,...a)}}});return t}function rt(e,t=[]){let n=Object.assign({},e);for(let l of t)l in n&&delete n[l];return n}function Vt(e){return e==null?!1:typeof e.type=="string"||typeof e.type=="object"||typeof e.type=="function"}var ge=(e=>(e[e.None=1]="None",e[e.Focusable=2]="Focusable",e[e.Hidden=4]="Hidden",e))(ge||{});let Pe=A({name:"Hidden",props:{as:{type:[Object,String],default:"div"},features:{type:Number,default:1}},setup(e,{slots:t,attrs:n}){return()=>{var l;let{features:r,...a}=e,i={"aria-hidden":(r&2)===2?!0:(l=a["aria-hidden"])!=null?l:void 0,hidden:(r&4)===4?!0:void 0,style:{position:"fixed",top:1,left:1,width:1,height:0,padding:0,margin:-1,overflow:"hidden",clip:"rect(0, 0, 0, 0)",whiteSpace:"nowrap",borderWidth:"0",...(r&4)===4&&(r&2)!==2&&{display:"none"}}};return R({ourProps:i,theirProps:a,slot:{},attrs:n,slots:t,name:"Hidden"})}}}),at=Symbol("Context");var L=(e=>(e[e.Open=1]="Open",e[e.Closed=2]="Closed",e[e.Closing=4]="Closing",e[e.Opening=8]="Opening",e))(L||{});function qt(){return Re()!==null}function Re(){return P(at,null)}function Gt(e){N(at,e)}var ot=(e=>(e.Space=" ",e.Enter="Enter",e.Escape="Escape",e.Backspace="Backspace",e.Delete="Delete",e.ArrowLeft="ArrowLeft",e.ArrowUp="ArrowUp",e.ArrowRight="ArrowRight",e.ArrowDown="ArrowDown",e.Home="Home",e.End="End",e.PageUp="PageUp",e.PageDown="PageDown",e.Tab="Tab",e))(ot||{});function Kt(e){function t(){document.readyState!=="loading"&&(e(),document.removeEventListener("DOMContentLoaded",t))}typeof window<"u"&&typeof document<"u"&&(document.addEventListener("DOMContentLoaded",t),t())}let q=[];Kt(()=>{function e(t){t.target instanceof HTMLElement&&t.target!==document.body&&q[0]!==t.target&&(q.unshift(t.target),q=q.filter(n=>n!=null&&n.isConnected),q.splice(10))}window.addEventListener("click",e,{capture:!0}),window.addEventListener("mousedown",e,{capture:!0}),window.addEventListener("focus",e,{capture:!0}),document.body.addEventListener("click",e,{capture:!0}),document.body.addEventListener("mousedown",e,{capture:!0}),document.body.addEventListener("focus",e,{capture:!0})});function it(e,t,n,l){ae.isServer||x(r=>{e=e??window,e.addEventListener(t,n,l),r(()=>e.removeEventListener(t,n,l))})}var le=(e=>(e[e.Forwards=0]="Forwards",e[e.Backwards=1]="Backwards",e))(le||{});function Yt(){let e=g(0);return tt("keydown",t=>{t.key==="Tab"&&(e.value=t.shiftKey?1:0)}),e}function ut(e){if(!e)return new Set;if(typeof e=="function")return new Set(e());let t=new Set;for(let n of e.value){let l=E(n);l instanceof HTMLElement&&t.add(l)}return t}var st=(e=>(e[e.None=1]="None",e[e.InitialFocus=2]="InitialFocus",e[e.TabLock=4]="TabLock",e[e.FocusLock=8]="FocusLock",e[e.RestoreFocus=16]="RestoreFocus",e[e.All=30]="All",e))(st||{});let te=Object.assign(A({name:"FocusTrap",props:{as:{type:[Object,String],default:"div"},initialFocus:{type:Object,default:null},features:{type:Number,default:30},containers:{type:[Object,Function],default:g(new Set)}},inheritAttrs:!1,setup(e,{attrs:t,slots:n,expose:l}){let r=g(null);l({el:r,$el:r});let a=h(()=>J(r)),i=g(!1);$(()=>i.value=!0),M(()=>i.value=!1),Xt({ownerDocument:a},h(()=>i.value&&!!(e.features&16)));let o=Qt({ownerDocument:a,container:r,initialFocus:h(()=>e.initialFocus)},h(()=>i.value&&!!(e.features&2)));Zt({ownerDocument:a,container:r,containers:e.containers,previousActiveElement:o},h(()=>i.value&&!!(e.features&8)));let u=Yt();function s(v){let f=E(r);f&&(p=>p())(()=>{k(u.value,{[le.Forwards]:()=>{me(f,I.First,{skipElements:[v.relatedTarget]})},[le.Backwards]:()=>{me(f,I.Last,{skipElements:[v.relatedTarget]})}})})}let d=g(!1);function m(v){v.key==="Tab"&&(d.value=!0,requestAnimationFrame(()=>{d.value=!1}))}function c(v){if(!i.value)return;let f=ut(e.containers);E(r)instanceof HTMLElement&&f.add(E(r));let p=v.relatedTarget;p instanceof HTMLElement&&p.dataset.headlessuiFocusGuard!=="true"&&(dt(f,p)||(d.value?me(E(r),k(u.value,{[le.Forwards]:()=>I.Next,[le.Backwards]:()=>I.Previous})|I.WrapAround,{relativeTo:v.target}):v.target instanceof HTMLElement&&K(v.target)))}return()=>{let v={},f={ref:r,onKeydown:m,onFocusout:c},{features:p,initialFocus:w,containers:C,...T}=e;return S(Qe,[!!(p&4)&&S(Pe,{as:"button",type:"button","data-headlessui-focus-guard":!0,onFocus:s,features:ge.Focusable}),R({ourProps:f,theirProps:{...t,...T},slot:v,attrs:t,slots:n,name:"FocusTrap"}),!!(p&4)&&S(Pe,{as:"button",type:"button","data-headlessui-focus-guard":!0,onFocus:s,features:ge.Focusable})])}}}),{features:st});function zt(e){let t=g(q.slice());return Z([e],([n],[l])=>{l===!0&&n===!1?ke(()=>{t.value.splice(0)}):l===!1&&n===!0&&(t.value=q.slice())},{flush:"post"}),()=>{var n;return(n=t.value.find(l=>l!=null&&l.isConnected))!=null?n:null}}function Xt({ownerDocument:e},t){let n=zt(t);$(()=>{x(()=>{var l,r;t.value||((l=e.value)==null?void 0:l.activeElement)===((r=e.value)==null?void 0:r.body)&&K(n())},{flush:"post"})}),M(()=>{t.value&&K(n())})}function Qt({ownerDocument:e,container:t,initialFocus:n},l){let r=g(null),a=g(!1);return $(()=>a.value=!0),M(()=>a.value=!1),$(()=>{Z([t,n,l],(i,o)=>{if(i.every((s,d)=>(o==null?void 0:o[d])===s)||!l.value)return;let u=E(t);u&&ke(()=>{var s,d;if(!a.value)return;let m=E(n),c=(s=e.value)==null?void 0:s.activeElement;if(m){if(m===c){r.value=c;return}}else if(u.contains(c)){r.value=c;return}m?K(m):me(u,I.First|I.NoScroll)===Ze.Error&&console.warn("There are no focusable elements inside the <FocusTrap />"),r.value=(d=e.value)==null?void 0:d.activeElement})},{immediate:!0,flush:"post"})}),r}function Zt({ownerDocument:e,container:t,containers:n,previousActiveElement:l},r){var a;it((a=e.value)==null?void 0:a.defaultView,"focus",i=>{if(!r.value)return;let o=ut(n);E(t)instanceof HTMLElement&&o.add(E(t));let u=l.value;if(!u)return;let s=i.target;s&&s instanceof HTMLElement?dt(o,s)?(l.value=s,K(s)):(i.preventDefault(),i.stopPropagation(),K(u)):K(l.value)},!0)}function dt(e,t){for(let n of e)if(n.contains(t))return!0;return!1}function Jt(e){let t=bt(e.getSnapshot());return M(e.subscribe(()=>{t.value=e.getSnapshot()})),t}function en(e,t){let n=e(),l=new Set;return{getSnapshot(){return n},subscribe(r){return l.add(r),()=>l.delete(r)},dispatch(r,...a){let i=t[r].call(n,...a);i&&(n=i,l.forEach(o=>o()))}}}function tn(){let e;return{before({doc:t}){var n;let l=t.documentElement;e=((n=t.defaultView)!=null?n:window).innerWidth-l.clientWidth},after({doc:t,d:n}){let l=t.documentElement,r=l.clientWidth-l.offsetWidth,a=e-r;n.style(l,"paddingRight",`${a}px`)}}}function nn(){return et()?{before({doc:e,d:t,meta:n}){function l(r){return n.containers.flatMap(a=>a()).some(a=>a.contains(r))}t.microTask(()=>{var r;if(window.getComputedStyle(e.documentElement).scrollBehavior!=="auto"){let o=re();o.style(e.documentElement,"scrollBehavior","auto"),t.add(()=>t.microTask(()=>o.dispose()))}let a=(r=window.scrollY)!=null?r:window.pageYOffset,i=null;t.addEventListener(e,"click",o=>{if(o.target instanceof HTMLElement)try{let u=o.target.closest("a");if(!u)return;let{hash:s}=new URL(u.href),d=e.querySelector(s);d&&!l(d)&&(i=d)}catch{}},!0),t.addEventListener(e,"touchstart",o=>{if(o.target instanceof HTMLElement)if(l(o.target)){let u=o.target;for(;u.parentElement&&l(u.parentElement);)u=u.parentElement;t.style(u,"overscrollBehavior","contain")}else t.style(o.target,"touchAction","none")}),t.addEventListener(e,"touchmove",o=>{if(o.target instanceof HTMLElement){if(o.target.tagName==="INPUT")return;if(l(o.target)){let u=o.target;for(;u.parentElement&&u.dataset.headlessuiPortal!==""&&!(u.scrollHeight>u.clientHeight||u.scrollWidth>u.clientWidth);)u=u.parentElement;u.dataset.headlessuiPortal===""&&o.preventDefault()}else o.preventDefault()}},{passive:!1}),t.add(()=>{var o;let u=(o=window.scrollY)!=null?o:window.pageYOffset;a!==u&&window.scrollTo(0,a),i&&i.isConnected&&(i.scrollIntoView({block:"nearest"}),i=null)})})}}:{}}function ln(){return{before({doc:e,d:t}){t.style(e.documentElement,"overflow","hidden")}}}function rn(e){let t={};for(let n of e)Object.assign(t,n(t));return t}let G=en(()=>new Map,{PUSH(e,t){var n;let l=(n=this.get(e))!=null?n:{doc:e,count:0,d:re(),meta:new Set};return l.count++,l.meta.add(t),this.set(e,l),this},POP(e,t){let n=this.get(e);return n&&(n.count--,n.meta.delete(t)),this},SCROLL_PREVENT({doc:e,d:t,meta:n}){let l={doc:e,d:t,meta:rn(n)},r=[nn(),tn(),ln()];r.forEach(({before:a})=>a==null?void 0:a(l)),r.forEach(({after:a})=>a==null?void 0:a(l))},SCROLL_ALLOW({d:e}){e.dispose()},TEARDOWN({doc:e}){this.delete(e)}});G.subscribe(()=>{let e=G.getSnapshot(),t=new Map;for(let[n]of e)t.set(n,n.documentElement.style.overflow);for(let n of e.values()){let l=t.get(n.doc)==="hidden",r=n.count!==0;(r&&!l||!r&&l)&&G.dispatch(n.count>0?"SCROLL_PREVENT":"SCROLL_ALLOW",n),n.count===0&&G.dispatch("TEARDOWN",n)}});function an(e,t,n){let l=Jt(G),r=h(()=>{let a=e.value?l.value.get(e.value):void 0;return a?a.count>0:!1});return Z([e,t],([a,i],[o],u)=>{if(!a||!i)return;G.dispatch("PUSH",a,n);let s=!1;u(()=>{s||(G.dispatch("POP",o??a,n),s=!0)})},{immediate:!0}),r}let $e=new Map,ne=new Map;function Ge(e,t=g(!0)){x(n=>{var l;if(!t.value)return;let r=E(e);if(!r)return;n(function(){var i;if(!r)return;let o=(i=ne.get(r))!=null?i:1;if(o===1?ne.delete(r):ne.set(r,o-1),o!==1)return;let u=$e.get(r);u&&(u["aria-hidden"]===null?r.removeAttribute("aria-hidden"):r.setAttribute("aria-hidden",u["aria-hidden"]),r.inert=u.inert,$e.delete(r))});let a=(l=ne.get(r))!=null?l:0;ne.set(r,a+1),a===0&&($e.set(r,{"aria-hidden":r.getAttribute("aria-hidden"),inert:r.inert}),r.setAttribute("aria-hidden","true"),r.inert=!0)})}function on({defaultContainers:e=[],portals:t,mainTreeNodeRef:n}={}){let l=g(null),r=J(l);function a(){var i,o,u;let s=[];for(let d of e)d!==null&&(d instanceof HTMLElement?s.push(d):"value"in d&&d.value instanceof HTMLElement&&s.push(d.value));if(t!=null&&t.value)for(let d of t.value)s.push(d);for(let d of(i=r==null?void 0:r.querySelectorAll("html > *, body > *"))!=null?i:[])d!==document.body&&d!==document.head&&d instanceof HTMLElement&&d.id!=="headlessui-portal-root"&&(d.contains(E(l))||d.contains((u=(o=E(l))==null?void 0:o.getRootNode())==null?void 0:u.host)||s.some(m=>d.contains(m))||s.push(d));return s}return{resolveContainers:a,contains(i){return a().some(o=>o.contains(i))},mainTreeNodeRef:l,MainTreeNode(){return n!=null?null:S(Pe,{features:ge.Hidden,ref:l})}}}let ct=Symbol("ForcePortalRootContext");function un(){return P(ct,!1)}let Ke=A({name:"ForcePortalRoot",props:{as:{type:[Object,String],default:"template"},force:{type:Boolean,default:!1}},setup(e,{slots:t,attrs:n}){return N(ct,e.force),()=>{let{force:l,...r}=e;return R({theirProps:r,ourProps:{},slot:{},slots:t,attrs:n,name:"ForcePortalRoot"})}}}),ft=Symbol("StackContext");var xe=(e=>(e[e.Add=0]="Add",e[e.Remove=1]="Remove",e))(xe||{});function sn(){return P(ft,()=>{})}function dn({type:e,enabled:t,element:n,onUpdate:l}){let r=sn();function a(...i){l==null||l(...i),r(...i)}$(()=>{Z(t,(i,o)=>{i?a(0,e,n):o===!0&&a(1,e,n)},{immediate:!0,flush:"sync"})}),M(()=>{t.value&&a(1,e,n)}),N(ft,a)}let cn=Symbol("DescriptionContext");function fn({slot:e=g({}),name:t="Description",props:n={}}={}){let l=g([]);function r(a){return l.value.push(a),()=>{let i=l.value.indexOf(a);i!==-1&&l.value.splice(i,1)}}return N(cn,{register:r,slot:e,name:t,props:n}),h(()=>l.value.length>0?l.value.join(" "):void 0)}function vn(e){let t=J(e);if(!t){if(e===null)return null;throw new Error(`[Headless UI]: Cannot find ownerDocument for contextElement: ${e}`)}let n=t.getElementById("headlessui-portal-root");if(n)return n;let l=t.createElement("div");return l.setAttribute("id","headlessui-portal-root"),t.body.appendChild(l)}const Ae=new WeakMap;function pn(e){var t;return(t=Ae.get(e))!=null?t:0}function Ye(e,t){let n=t(pn(e));return n<=0?Ae.delete(e):Ae.set(e,n),n}let mn=A({name:"Portal",props:{as:{type:[Object,String],default:"div"}},setup(e,{slots:t,attrs:n}){let l=g(null),r=h(()=>J(l)),a=un(),i=P(vt,null),o=g(a===!0||i==null?vn(l.value):i.resolveTarget());o.value&&Ye(o.value,c=>c+1);let u=g(!1);$(()=>{u.value=!0}),x(()=>{a||i!=null&&(o.value=i.resolveTarget())});let s=P(Ce,null),d=!1,m=Tt();return Z(l,()=>{if(d||!s)return;let c=E(l);c&&(M(s.register(c),m),d=!0)}),M(()=>{var c,v;let f=(c=r.value)==null?void 0:c.getElementById("headlessui-portal-root");!f||o.value!==f||Ye(o.value,p=>p-1)||o.value.children.length>0||(v=o.value.parentElement)==null||v.removeChild(o.value)}),()=>{if(!u.value||o.value===null)return null;let c={ref:l,"data-headlessui-portal":""};return S(Et,{to:o.value},R({ourProps:c,theirProps:e,slot:{},attrs:n,slots:t,name:"Portal"}))}}}),Ce=Symbol("PortalParentContext");function hn(){let e=P(Ce,null),t=g([]);function n(a){return t.value.push(a),e&&e.register(a),()=>l(a)}function l(a){let i=t.value.indexOf(a);i!==-1&&t.value.splice(i,1),e&&e.unregister(a)}let r={register:n,unregister:l,portals:t};return[t,A({name:"PortalWrapper",setup(a,{slots:i}){return N(Ce,r),()=>{var o;return(o=i.default)==null?void 0:o.call(i)}}})]}let vt=Symbol("PortalGroupContext"),gn=A({name:"PortalGroup",props:{as:{type:[Object,String],default:"template"},target:{type:Object,default:null}},setup(e,{attrs:t,slots:n}){let l=St({resolveTarget(){return e.target}});return N(vt,l),()=>{let{target:r,...a}=e;return R({theirProps:a,ourProps:{},slot:{},attrs:t,slots:n,name:"PortalGroup"})}}});var yn=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(yn||{});let De=Symbol("DialogContext");function je(e){let t=P(De,null);if(t===null){let n=new Error(`<${e} /> is missing a parent <Dialog /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(n,je),n}return t}let ve="DC8F892D-2EBD-447C-A4C8-A03058436FF4",wn=A({name:"Dialog",inheritAttrs:!1,props:{as:{type:[Object,String],default:"div"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0},open:{type:[Boolean,String],default:ve},initialFocus:{type:Object,default:null},id:{type:String,default:null},role:{type:String,default:"dialog"}},emits:{close:e=>!0},setup(e,{emit:t,attrs:n,slots:l,expose:r}){var a,i;let o=(a=e.id)!=null?a:`headlessui-dialog-${ye()}`,u=g(!1);$(()=>{u.value=!0});let s=!1,d=h(()=>e.role==="dialog"||e.role==="alertdialog"?e.role:(s||(s=!0,console.warn(`Invalid role [${d}] passed to <Dialog />. Only \`dialog\` and and \`alertdialog\` are supported. Using \`dialog\` instead.`)),"dialog")),m=g(0),c=Re(),v=h(()=>e.open===ve&&c!==null?(c.value&L.Open)===L.Open:e.open),f=g(null),p=h(()=>J(f));if(r({el:f,$el:f}),!(e.open!==ve||c!==null))throw new Error("You forgot to provide an `open` prop to the `Dialog`.");if(typeof v.value!="boolean")throw new Error(`You provided an \`open\` prop to the \`Dialog\`, but the value is not a boolean. Received: ${v.value===ve?void 0:e.open}`);let w=h(()=>u.value&&v.value?0:1),C=h(()=>w.value===0),T=h(()=>m.value>1),U=P(De,null)!==null,[oe,ie]=hn(),{resolveContainers:Y,mainTreeNodeRef:ue,MainTreeNode:se}=on({portals:oe,defaultContainers:[h(()=>{var y;return(y=z.panelRef.value)!=null?y:f.value})]}),be=h(()=>T.value?"parent":"leaf"),de=h(()=>c!==null?(c.value&L.Closing)===L.Closing:!1),Ee=h(()=>U||de.value?!1:C.value),Se=h(()=>{var y,b,F;return(F=Array.from((b=(y=p.value)==null?void 0:y.querySelectorAll("body > *"))!=null?b:[]).find(O=>O.id==="headlessui-portal-root"?!1:O.contains(E(ue))&&O instanceof HTMLElement))!=null?F:null});Ge(Se,Ee);let D=h(()=>T.value?!0:C.value),ee=h(()=>{var y,b,F;return(F=Array.from((b=(y=p.value)==null?void 0:y.querySelectorAll("[data-headlessui-portal]"))!=null?b:[]).find(O=>O.contains(E(ue))&&O instanceof HTMLElement))!=null?F:null});Ge(ee,D),dn({type:"Dialog",enabled:h(()=>w.value===0),element:f,onUpdate:(y,b)=>{if(b==="Dialog")return k(y,{[xe.Add]:()=>m.value+=1,[xe.Remove]:()=>m.value-=1})}});let j=fn({name:"DialogDescription",slot:h(()=>({open:v.value}))}),H=g(null),z={titleId:H,panelRef:g(null),dialogState:w,setTitleId(y){H.value!==y&&(H.value=y)},close(){t("close",!1)}};N(De,z);let Ie=h(()=>!(!C.value||T.value));Wt(Y,(y,b)=>{y.preventDefault(),z.close(),Lt(()=>b==null?void 0:b.focus())},Ie);let _e=h(()=>!(T.value||w.value!==0));it((i=p.value)==null?void 0:i.defaultView,"keydown",y=>{_e.value&&(y.defaultPrevented||y.key===ot.Escape&&(y.preventDefault(),y.stopPropagation(),z.close()))});let Ue=h(()=>!(de.value||w.value!==0||U));return an(p,Ue,y=>{var b;return{containers:[...(b=y.containers)!=null?b:[],Y]}}),x(y=>{if(w.value!==0)return;let b=E(f);if(!b)return;let F=new ResizeObserver(O=>{for(let Te of O){let ce=Te.target.getBoundingClientRect();ce.x===0&&ce.y===0&&ce.width===0&&ce.height===0&&z.close()}});F.observe(b),y(()=>F.disconnect())}),()=>{let{open:y,initialFocus:b,...F}=e,O={...n,ref:f,id:o,role:d.value,"aria-modal":w.value===0?!0:void 0,"aria-labelledby":H.value,"aria-describedby":j.value},Te={open:w.value===0};return S(Ke,{force:!0},()=>[S(mn,()=>S(gn,{target:f.value},()=>S(Ke,{force:!1},()=>S(te,{initialFocus:b,containers:Y,features:C.value?k(be.value,{parent:te.features.RestoreFocus,leaf:te.features.All&~te.features.FocusLock}):te.features.None},()=>S(ie,{},()=>R({ourProps:O,theirProps:{...F,...n},slot:Te,attrs:n,slots:l,visible:w.value===0,features:he.RenderStrategy|he.Static,name:"Dialog"})))))),S(se)])}}}),bn=A({name:"DialogPanel",props:{as:{type:[Object,String],default:"div"},id:{type:String,default:null}},setup(e,{attrs:t,slots:n,expose:l}){var r;let a=(r=e.id)!=null?r:`headlessui-dialog-panel-${ye()}`,i=je("DialogPanel");l({el:i.panelRef,$el:i.panelRef});function o(u){u.stopPropagation()}return()=>{let{...u}=e,s={id:a,ref:i.panelRef,onClick:o};return R({ourProps:s,theirProps:u,slot:{open:i.dialogState.value===0},attrs:t,slots:n,name:"DialogPanel"})}}}),En=A({name:"DialogTitle",props:{as:{type:[Object,String],default:"h2"},id:{type:String,default:null}},setup(e,{attrs:t,slots:n}){var l;let r=(l=e.id)!=null?l:`headlessui-dialog-title-${ye()}`,a=je("DialogTitle");return $(()=>{a.setTitleId(r),M(()=>a.setTitleId(null))}),()=>{let{...i}=e;return R({ourProps:{id:r},theirProps:i,slot:{open:a.dialogState.value===0},attrs:t,slots:n,name:"DialogTitle"})}}});function Sn(e){let t={called:!1};return(...n)=>{if(!t.called)return t.called=!0,e(...n)}}function Fe(e,...t){e&&t.length>0&&e.classList.add(...t)}function pe(e,...t){e&&t.length>0&&e.classList.remove(...t)}var Ne=(e=>(e.Finished="finished",e.Cancelled="cancelled",e))(Ne||{});function Tn(e,t){let n=re();if(!e)return n.dispose;let{transitionDuration:l,transitionDelay:r}=getComputedStyle(e),[a,i]=[l,r].map(o=>{let[u=0]=o.split(",").filter(Boolean).map(s=>s.includes("ms")?parseFloat(s):parseFloat(s)*1e3).sort((s,d)=>d-s);return u});return a!==0?n.setTimeout(()=>t("finished"),a+i):t("finished"),n.add(()=>t("cancelled")),n.dispose}function ze(e,t,n,l,r,a){let i=re(),o=a!==void 0?Sn(a):()=>{};return pe(e,...r),Fe(e,...t,...n),i.nextFrame(()=>{pe(e,...n),Fe(e,...l),i.add(Tn(e,u=>(pe(e,...l,...t),Fe(e,...r),o(u))))}),i.add(()=>pe(e,...t,...n,...l,...r)),i.add(()=>o("cancelled")),i.dispose}function V(e=""){return e.split(/\s+/).filter(t=>t.length>1)}let He=Symbol("TransitionContext");var Ln=(e=>(e.Visible="visible",e.Hidden="hidden",e))(Ln||{});function $n(){return P(He,null)!==null}function Fn(){let e=P(He,null);if(e===null)throw new Error("A <TransitionChild /> is used but it is missing a parent <TransitionRoot />.");return e}function On(){let e=P(Be,null);if(e===null)throw new Error("A <TransitionChild /> is used but it is missing a parent <TransitionRoot />.");return e}let Be=Symbol("NestingContext");function we(e){return"children"in e?we(e.children):e.value.filter(({state:t})=>t==="visible").length>0}function pt(e){let t=g([]),n=g(!1);$(()=>n.value=!0),M(()=>n.value=!1);function l(a,i=_.Hidden){let o=t.value.findIndex(({id:u})=>u===a);o!==-1&&(k(i,{[_.Unmount](){t.value.splice(o,1)},[_.Hidden](){t.value[o].state="hidden"}}),!we(t)&&n.value&&(e==null||e()))}function r(a){let i=t.value.find(({id:o})=>o===a);return i?i.state!=="visible"&&(i.state="visible"):t.value.push({id:a,state:"visible"}),()=>l(a,_.Unmount)}return{children:t,register:r,unregister:l}}let mt=he.RenderStrategy,Me=A({props:{as:{type:[Object,String],default:"div"},show:{type:[Boolean],default:null},unmount:{type:[Boolean],default:!0},appear:{type:[Boolean],default:!1},enter:{type:[String],default:""},enterFrom:{type:[String],default:""},enterTo:{type:[String],default:""},entered:{type:[String],default:""},leave:{type:[String],default:""},leaveFrom:{type:[String],default:""},leaveTo:{type:[String],default:""}},emits:{beforeEnter:()=>!0,afterEnter:()=>!0,beforeLeave:()=>!0,afterLeave:()=>!0},setup(e,{emit:t,attrs:n,slots:l,expose:r}){let a=g(0);function i(){a.value|=L.Opening,t("beforeEnter")}function o(){a.value&=~L.Opening,t("afterEnter")}function u(){a.value|=L.Closing,t("beforeLeave")}function s(){a.value&=~L.Closing,t("afterLeave")}if(!$n()&&qt())return()=>S(ht,{...e,onBeforeEnter:i,onAfterEnter:o,onBeforeLeave:u,onAfterLeave:s},l);let d=g(null),m=h(()=>e.unmount?_.Unmount:_.Hidden);r({el:d,$el:d});let{show:c,appear:v}=Fn(),{register:f,unregister:p}=On(),w=g(c.value?"visible":"hidden"),C={value:!0},T=ye(),U={value:!1},oe=pt(()=>{!U.value&&w.value!=="hidden"&&(w.value="hidden",p(T),s())});$(()=>{let D=f(T);M(D)}),x(()=>{if(m.value===_.Hidden&&T){if(c.value&&w.value!=="visible"){w.value="visible";return}k(w.value,{hidden:()=>p(T),visible:()=>f(T)})}});let ie=V(e.enter),Y=V(e.enterFrom),ue=V(e.enterTo),se=V(e.entered),be=V(e.leave),de=V(e.leaveFrom),Ee=V(e.leaveTo);$(()=>{x(()=>{if(w.value==="visible"){let D=E(d);if(D instanceof Comment&&D.data==="")throw new Error("Did you forget to passthrough the `ref` to the actual DOM node?")}})});function Se(D){let ee=C.value&&!v.value,j=E(d);!j||!(j instanceof HTMLElement)||ee||(U.value=!0,c.value&&i(),c.value||u(),D(c.value?ze(j,ie,Y,ue,se,H=>{U.value=!1,H===Ne.Finished&&o()}):ze(j,be,de,Ee,se,H=>{U.value=!1,H===Ne.Finished&&(we(oe)||(w.value="hidden",p(T),s()))})))}return $(()=>{Z([c],(D,ee,j)=>{Se(j),C.value=!1},{immediate:!0})}),N(Be,oe),Gt(h(()=>k(w.value,{visible:L.Open,hidden:L.Closed})|a.value)),()=>{let{appear:D,show:ee,enter:j,enterFrom:H,enterTo:z,entered:Ie,leave:_e,leaveFrom:Ue,leaveTo:y,...b}=e,F={ref:d},O={...b,...v.value&&c.value&&ae.isServer?{class:$t([n.class,b.class,...ie,...Y])}:{}};return R({theirProps:O,ourProps:F,slot:{},slots:l,attrs:n,features:mt,visible:w.value==="visible",name:"TransitionChild"})}}}),Pn=Me,ht=A({inheritAttrs:!1,props:{as:{type:[Object,String],default:"div"},show:{type:[Boolean],default:null},unmount:{type:[Boolean],default:!0},appear:{type:[Boolean],default:!1},enter:{type:[String],default:""},enterFrom:{type:[String],default:""},enterTo:{type:[String],default:""},entered:{type:[String],default:""},leave:{type:[String],default:""},leaveFrom:{type:[String],default:""},leaveTo:{type:[String],default:""}},emits:{beforeEnter:()=>!0,afterEnter:()=>!0,beforeLeave:()=>!0,afterLeave:()=>!0},setup(e,{emit:t,attrs:n,slots:l}){let r=Re(),a=h(()=>e.show===null&&r!==null?(r.value&L.Open)===L.Open:e.show);x(()=>{if(![!0,!1].includes(a.value))throw new Error('A <Transition /> is used but it is missing a `:show="true | false"` prop.')});let i=g(a.value?"visible":"hidden"),o=pt(()=>{i.value="hidden"}),u=g(!0),s={show:a,appear:h(()=>e.appear||!u.value)};return $(()=>{x(()=>{u.value=!1,a.value?i.value="visible":we(o)||(i.value="hidden")})}),N(Be,o),N(He,s),()=>{let d=rt(e,["show","appear","unmount","onBeforeEnter","onBeforeLeave","onAfterEnter","onAfterLeave"]),m={unmount:e.unmount};return R({ourProps:{...m,as:"template"},theirProps:{},slot:{},slots:{...l,default:()=>[S(Pn,{onBeforeEnter:()=>t("beforeEnter"),onAfterEnter:()=>t("afterEnter"),onBeforeLeave:()=>t("beforeLeave"),onAfterLeave:()=>t("afterLeave"),...n,...m,...d},l.default)]},attrs:{},features:mt,visible:i.value==="visible",name:"Transition"})}}});const xn={class:"fixed z-50 inset-0 overflow-y-auto"},An={class:"flex items-center justify-center min-h-full p-4 text-center sm:p-0"},Cn={class:"mt-3 text-center sm:mt-0 sm:ml-2 sm:mr-2 sm:text-left"},Dn={class:"border-b border-gray-200 bg-white px-2 py-1 md:py-3"},Nn={class:"mt-5 text-lg text-gray-700 p-1"},Rn={__name:"Modal",props:{open:Boolean},emits:["modalClose"],setup(e,{emit:t}){const n=t;function l(){n("modalClose")}return(r,a)=>(Xe(),Ft(W(ht),{as:"template",show:e.open},{default:X(()=>[Q(W(wn),{as:"div",class:"relative z-50",onClose:l},{default:X(()=>[Q(W(Me),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0","enter-to":"opacity-100",leave:"ease-in duration-200","leave-from":"opacity-100","leave-to":"opacity-0"},{default:X(()=>a[1]||(a[1]=[B("div",{class:"fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"},null,-1)])),_:1}),B("div",xn,[B("div",An,[Q(W(Me),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to":"opacity-100 translate-y-0 sm:scale-100",leave:"ease-in duration-200","leave-from":"opacity-100 translate-y-0 sm:scale-100","leave-to":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:X(()=>[Q(W(bn),{class:"relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-visible shadow-xl transform transition-all my-2 md:my-8 max-w-4xl max-h-4xl w-full p-2 md:p-6 flex flex-col",onClick:a[0]||(a[0]=Ot(()=>{},["stop"]))},{default:X(()=>[B("div",Cn,[B("div",Dn,[Q(W(En),{as:"h3",class:"text-xl leading-6 font-medium text-gray-900 flex justify-between"},{default:X(()=>[We(r.$slots,"header"),B("button",{type:"button",class:"bg-white rounded-md text-gray-400 hover:text-gray-500",onClick:l},[a[2]||(a[2]=B("span",{class:"sr-only"},"Close",-1)),Q(W(Pt),{class:"h-6 w-6","aria-hidden":"true"})])]),_:3})]),B("div",Nn,[We(r.$slots,"default")])])]),_:3})]),_:3})])])]),_:3})]),_:3},8,["show"]))}};export{Rn as _};
