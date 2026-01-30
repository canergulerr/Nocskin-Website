(function(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else if(typeof exports === 'object')
		exports["offers"] = factory();
	else
		root["og"] = root["og"] || {}, root["og"]["offers"] = factory();
})(window, function() {
  var module={}, exports={};(factory => {
if(typeof exports === 'object' && typeof module === 'object')
  module.exports = factory();
else if(typeof define === 'function' && define.amd)
  define([], factory);
else {
  window.og = window.og || {};
  window.og['offers'] = factory();
}      
})(()=>{ 
var lib=(()=>{var Ya=Object.create;var gt=Object.defineProperty;var Wa=Object.getOwnPropertyDescriptor;var Ka=Object.getOwnPropertyNames;var Ja=Object.getPrototypeOf,Qa=Object.prototype.hasOwnProperty;var n=(t,e)=>gt(t,"name",{value:e,configurable:!0});var X=(t,e)=>()=>(e||t((e={exports:{}}).exports,e),e.exports),jn=(t,e)=>{for(var r in e)gt(t,r,{get:e[r],enumerable:!0})},Gn=(t,e,r,o)=>{if(e&&typeof e=="object"||typeof e=="function")for(let i of Ka(e))!Qa.call(t,i)&&i!==r&&gt(t,i,{get:()=>e[i],enumerable:!(o=Wa(e,i))||o.enumerable});return t};var ae=(t,e,r)=>(r=t!=null?Ya(Ja(t)):{},Gn(e||!t||!t.__esModule?gt(r,"default",{value:t,enumerable:!0}):r,t)),Za=t=>Gn(gt({},"__esModule",{value:!0}),t);var Yt=X((zt,Qn)=>{(function(t,e){typeof zt=="object"&&typeof Qn<"u"?e(zt):typeof define=="function"&&define.amd?define(["exports"],e):(t=t||self,e(t.throttleDebounce={}))})(zt,function(t){"use strict";function e(o,i,s,a){var c,l=!1,p=0;function d(){c&&clearTimeout(c)}n(d,"clearExistingTimeout");function f(){d(),l=!0}n(f,"cancel"),typeof i!="boolean"&&(a=s,s=i,i=void 0);function h(){for(var _=arguments.length,P=new Array(_),m=0;m<_;m++)P[m]=arguments[m];var E=this,T=Date.now()-p;if(l)return;function y(){p=Date.now(),s.apply(E,P)}n(y,"exec");function O(){c=void 0}n(O,"clear"),a&&!c&&y(),d(),a===void 0&&T>o?y():i!==!0&&(c=setTimeout(a?O:y,a===void 0?o-T:o))}return n(h,"wrapper"),h.cancel=f,h}n(e,"throttle");function r(o,i,s){return s===void 0?e(o,i,!1):e(o,s,i!==!1)}n(r,"debounce"),t.debounce=r,t.throttle=e,Object.defineProperty(t,"__esModule",{value:!0})})});var xt=X((Xu,yi)=>{var lc="Expected a function",ui="__lodash_hash_undefined__",pc="[object Function]",uc="[object GeneratorFunction]",dc=/[\\^$.*+?()[\]{}|]/g,fc=/^\[object .+?Constructor\]$/,hc=typeof window=="object"&&window&&window.Object===Object&&window,mc=typeof self=="object"&&self&&self.Object===Object&&self,di=hc||mc||Function("return this")();function gc(t,e){return t?.[e]}n(gc,"getValue");function yc(t){var e=!1;if(t!=null&&typeof t.toString!="function")try{e=!!(t+"")}catch{}return e}n(yc,"isHostObject");var bc=Array.prototype,Sc=Function.prototype,fi=Object.prototype,_o=di["__core-js_shared__"],pi=function(){var t=/[^.]+$/.exec(_o&&_o.keys&&_o.keys.IE_PROTO||"");return t?"Symbol(src)_1."+t:""}(),hi=Sc.toString,Eo=fi.hasOwnProperty,_c=fi.toString,Ec=RegExp("^"+hi.call(Eo).replace(dc,"\\$&").replace(/hasOwnProperty|(function).*?(?=\\\()| for .+?(?=\\\])/g,"$1.*?")+"$"),xc=bc.splice,Pc=mi(di,"Map"),Et=mi(Object,"create");function Re(t){var e=-1,r=t?t.length:0;for(this.clear();++e<r;){var o=t[e];this.set(o[0],o[1])}}n(Re,"Hash");function vc(){this.__data__=Et?Et(null):{}}n(vc,"hashClear");function Oc(t){return this.has(t)&&delete this.__data__[t]}n(Oc,"hashDelete");function Tc(t){var e=this.__data__;if(Et){var r=e[t];return r===ui?void 0:r}return Eo.call(e,t)?e[t]:void 0}n(Tc,"hashGet");function wc(t){var e=this.__data__;return Et?e[t]!==void 0:Eo.call(e,t)}n(wc,"hashHas");function Cc(t,e){var r=this.__data__;return r[t]=Et&&e===void 0?ui:e,this}n(Cc,"hashSet");Re.prototype.clear=vc;Re.prototype.delete=Oc;Re.prototype.get=Tc;Re.prototype.has=wc;Re.prototype.set=Cc;function Qe(t){var e=-1,r=t?t.length:0;for(this.clear();++e<r;){var o=t[e];this.set(o[0],o[1])}}n(Qe,"ListCache");function Rc(){this.__data__=[]}n(Rc,"listCacheClear");function Ac(t){var e=this.__data__,r=pr(e,t);if(r<0)return!1;var o=e.length-1;return r==o?e.pop():xc.call(e,r,1),!0}n(Ac,"listCacheDelete");function Ic(t){var e=this.__data__,r=pr(e,t);return r<0?void 0:e[r][1]}n(Ic,"listCacheGet");function Nc(t){return pr(this.__data__,t)>-1}n(Nc,"listCacheHas");function kc(t,e){var r=this.__data__,o=pr(r,t);return o<0?r.push([t,e]):r[o][1]=e,this}n(kc,"listCacheSet");Qe.prototype.clear=Rc;Qe.prototype.delete=Ac;Qe.prototype.get=Ic;Qe.prototype.has=Nc;Qe.prototype.set=kc;function Ae(t){var e=-1,r=t?t.length:0;for(this.clear();++e<r;){var o=t[e];this.set(o[0],o[1])}}n(Ae,"MapCache");function Fc(){this.__data__={hash:new Re,map:new(Pc||Qe),string:new Re}}n(Fc,"mapCacheClear");function qc(t){return ur(this,t).delete(t)}n(qc,"mapCacheDelete");function Dc(t){return ur(this,t).get(t)}n(Dc,"mapCacheGet");function Uc(t){return ur(this,t).has(t)}n(Uc,"mapCacheHas");function Lc(t,e){return ur(this,t).set(t,e),this}n(Lc,"mapCacheSet");Ae.prototype.clear=Fc;Ae.prototype.delete=qc;Ae.prototype.get=Dc;Ae.prototype.has=Uc;Ae.prototype.set=Lc;function pr(t,e){for(var r=t.length;r--;)if(Gc(t[r][0],e))return r;return-1}n(pr,"assocIndexOf");function Mc(t){if(!gi(t)||Vc(t))return!1;var e=Hc(t)||yc(t)?Ec:fc;return e.test(jc(t))}n(Mc,"baseIsNative");function ur(t,e){var r=t.__data__;return $c(e)?r[typeof e=="string"?"string":"hash"]:r.map}n(ur,"getMapData");function mi(t,e){var r=gc(t,e);return Mc(r)?r:void 0}n(mi,"getNative");function $c(t){var e=typeof t;return e=="string"||e=="number"||e=="symbol"||e=="boolean"?t!=="__proto__":t===null}n($c,"isKeyable");function Vc(t){return!!pi&&pi in t}n(Vc,"isMasked");function jc(t){if(t!=null){try{return hi.call(t)}catch{}try{return t+""}catch{}}return""}n(jc,"toSource");function xo(t,e){if(typeof t!="function"||e&&typeof e!="function")throw new TypeError(lc);var r=n(function(){var o=arguments,i=e?e.apply(this,o):o[0],s=r.cache;if(s.has(i))return s.get(i);var a=t.apply(this,o);return r.cache=s.set(i,a),a},"memoized");return r.cache=new(xo.Cache||Ae),r}n(xo,"memoize");xo.Cache=Ae;function Gc(t,e){return t===e||t!==t&&e!==e}n(Gc,"eq");function Hc(t){var e=gi(t)?_c.call(t):"";return e==pc||e==uc}n(Hc,"isFunction");function gi(t){var e=typeof t;return!!t&&(e=="object"||e=="function")}n(gi,"isObject");yi.exports=xo});var ns=X((Id,qo)=>{function gl(t,e){var r,o,i,s,a,c,l,p,d,f;for(r=t.length&3,o=t.length-r,i=e,a=3432918353,l=461845907,f=0;f<o;)d=t.charCodeAt(f)&255|(t.charCodeAt(++f)&255)<<8|(t.charCodeAt(++f)&255)<<16|(t.charCodeAt(++f)&255)<<24,++f,d=(d&65535)*a+(((d>>>16)*a&65535)<<16)&4294967295,d=d<<15|d>>>17,d=(d&65535)*l+(((d>>>16)*l&65535)<<16)&4294967295,i^=d,i=i<<13|i>>>19,s=(i&65535)*5+(((i>>>16)*5&65535)<<16)&4294967295,i=(s&65535)+27492+(((s>>>16)+58964&65535)<<16);switch(d=0,r){case 3:d^=(t.charCodeAt(f+2)&255)<<16;case 2:d^=(t.charCodeAt(f+1)&255)<<8;case 1:d^=t.charCodeAt(f)&255,d=(d&65535)*a+(((d>>>16)*a&65535)<<16)&4294967295,d=d<<15|d>>>17,d=(d&65535)*l+(((d>>>16)*l&65535)<<16)&4294967295,i^=d}return i^=t.length,i^=i>>>16,i=(i&65535)*2246822507+(((i>>>16)*2246822507&65535)<<16)&4294967295,i^=i>>>13,i=(i&65535)*3266489909+(((i>>>16)*3266489909&65535)<<16)&4294967295,i^=i>>>16,i>>>0}n(gl,"murmurhash3_32_gc");typeof qo<"u"&&(qo.exports=gl)});var is=X((Nd,Do)=>{function yl(t,e){for(var r=t.length,o=e^r,i=0,s;r>=4;)s=t.charCodeAt(i)&255|(t.charCodeAt(++i)&255)<<8|(t.charCodeAt(++i)&255)<<16|(t.charCodeAt(++i)&255)<<24,s=(s&65535)*1540483477+(((s>>>16)*1540483477&65535)<<16),s^=s>>>24,s=(s&65535)*1540483477+(((s>>>16)*1540483477&65535)<<16),o=(o&65535)*1540483477+(((o>>>16)*1540483477&65535)<<16)^s,r-=4,++i;switch(r){case 3:o^=(t.charCodeAt(i+2)&255)<<16;case 2:o^=(t.charCodeAt(i+1)&255)<<8;case 1:o^=t.charCodeAt(i)&255,o=(o&65535)*1540483477+(((o>>>16)*1540483477&65535)<<16)}return o^=o>>>13,o=(o&65535)*1540483477+(((o>>>16)*1540483477&65535)<<16),o^=o>>>15,o>>>0}n(yl,"murmurhash2_32_gc");typeof Do!==void 0&&(Do.exports=yl)});var as=X((kd,Pr)=>{var ss=ns(),bl=is();Pr.exports=ss;Pr.exports.murmur3=ss;Pr.exports.murmur2=bl});var Mr=X((ih,Fs)=>{var $l={PAR_OPEN:"(".charCodeAt(0),PAR_CLOSE:")".charCodeAt(0),OP_NOT:"!".charCodeAt(0),BINARY_AND:"&".charCodeAt(0),BINARY_OR:"|".charCodeAt(0),LITERAL:"LITERAL",END:"END",LEAF:"LEAF",ATOMIC:"ATOMIC"};Fs.exports=$l});var Ds=X((sh,qs)=>{var De=Mr(),Vl=n(t=>{let e="",r=[];for(let o of t){let i=o.charCodeAt(0);switch(i){case De.PAR_OPEN:case De.PAR_CLOSE:case De.OP_NOT:case De.BINARY_AND:case De.BINARY_OR:e&&(r.push({type:De.LITERAL,value:e}),e=""),r.push({type:i,value:o});break;default:e+=o}}return e&&r.push({type:De.LITERAL,value:e}),r},"Tokenizer");qs.exports=Vl});var Ls=X((ah,Us)=>{var xe=Mr(),jl=n(t=>{let e=[],r=[];return t.forEach(i=>{switch(i.type){case xe.LITERAL:e.unshift(i);break;case xe.BINARY_AND:case xe.BINARY_OR:case xe.OP_NOT:case xe.PAR_OPEN:r.push(i);break;case xe.PAR_CLOSE:for(;r.length&&r[r.length-1].type!==xe.PAR_OPEN;)e.unshift(r.pop());r.pop(),r.length&&r[r.length-1].type===xe.OP_NOT&&e.unshift(r.pop());break;default:break}}),r.length&&[...r.reverse(),...e]||e},"PolishNotation"),Gl=n(function*(t){for(let e=0;e<t.length-1;e++)yield t[e];return t[t.length-1]},"PolishGenerator");Us.exports={PolishNotation:jl,PolishGenerator:Gl}});var $s=X((ch,Ms)=>{var $=Mr(),B=class{constructor(e,r,o,i){this.op=e,this.left=r,this.right=o,this.literal=i}isLeaf(){return this.op===$.LEAF}isAtomic(){return this.isLeaf()||this.op===$.OP_NOT&&this.left.isLeaf()}getLiteralValue(){return this.literal}static CreateAnd(e,r){return new B($.BINARY_AND,e,r)}static CreateNot(e){return new B($.OP_NOT,e)}static CreateOr(e,r){return new B($.BINARY_OR,e,r)}static CreateLiteral(e){return new B($.LEAF,null,null,e)}};n(B,"ExpNode");var pt=n(t=>{let e=t.next().value;switch(e.type){case $.LITERAL:return B.CreateLiteral(e.value);case $.OP_NOT:return B.CreateNot(pt(t));case $.BINARY_AND:{let r=pt(t),o=pt(t);return B.CreateAnd(r,o)}case $.BINARY_OR:{let r=pt(t),o=pt(t);return B.CreateOr(r,o)}}return null},"make"),ut=n((t,e)=>{if(t.isLeaf())return e(t.getLiteralValue());if(t.op===$.OP_NOT)return!ut(t.left,e);if(t.op===$.BINARY_OR)return ut(t.left,e)||ut(t.right,e);if(t.op===$.BINARY_AND)return ut(t.left,e)&&ut(t.right,e)},"nodeEvaluator");Ms.exports={make:pt,nodeEvaluator:ut}});var Hs=X((lh,Gs)=>{var Hl=Ds(),Vs=Ls(),js=$s(),Bl=n((t,e)=>{let r=Hl(t),o=Vs.PolishNotation(r),i=Vs.PolishGenerator(o),s=js.make(i);return js.nodeEvaluator(s,e)},"parse");Gs.exports={parse:Bl}});var Hu={};jn(Hu,{addOptinChangedCallback:()=>xu,addTemplate:()=>Pu,autoInit:()=>ju,clear:()=>vu,config:()=>Ou,default:()=>Gu,disableOptinChangedCallbacks:()=>Tu,getOptins:()=>wu,getProductsForPurchasePost:()=>Cu,initialize:()=>Ru,isReady:()=>Eu,offers:()=>v,platform:()=>A,previewMode:()=>Au,register:()=>Iu,resolveSettings:()=>Nu,setAuthUrl:()=>ku,setEnvironment:()=>Fu,setLocale:()=>qu,setMerchantId:()=>Du,setPublicPath:()=>Uu,setTemplates:()=>Lu,setupCart:()=>Mu,setupProduct:()=>$u,setupProducts:()=>Vu,store:()=>Ba});function fo(t){var e,r=t.Symbol;return typeof r=="function"?r.observable?e=r.observable:(e=r("observable"),r.observable=e):e="@@observable",e}n(fo,"symbolObservablePonyfill");var Me;typeof self<"u"?Me=self:typeof window<"u"||typeof window<"u"?Me=window:typeof module<"u"?Me=module:Me=Function("return this")();var Xa=fo(Me),ho=Xa;var mo=n(function(){return Math.random().toString(36).substring(7).split("").join(".")},"randomString"),yt={INIT:"@@redux/INIT"+mo(),REPLACE:"@@redux/REPLACE"+mo(),PROBE_UNKNOWN_ACTION:n(function(){return"@@redux/PROBE_UNKNOWN_ACTION"+mo()},"PROBE_UNKNOWN_ACTION")};function ec(t){if(typeof t!="object"||t===null)return!1;for(var e=t;Object.getPrototypeOf(e)!==null;)e=Object.getPrototypeOf(e);return Object.getPrototypeOf(t)===e}n(ec,"isPlainObject");function go(t,e,r){var o;if(typeof e=="function"&&typeof r=="function"||typeof r=="function"&&typeof arguments[3]=="function")throw new Error("It looks like you are passing several store enhancers to createStore(). This is not supported. Instead, compose them together to a single function.");if(typeof e=="function"&&typeof r>"u"&&(r=e,e=void 0),typeof r<"u"){if(typeof r!="function")throw new Error("Expected the enhancer to be a function.");return r(go)(t,e)}if(typeof t!="function")throw new Error("Expected the reducer to be a function.");var i=t,s=e,a=[],c=a,l=!1;function p(){c===a&&(c=a.slice())}n(p,"ensureCanMutateNextListeners");function d(){if(l)throw new Error("You may not call store.getState() while the reducer is executing. The reducer has already received the state as an argument. Pass it down from the top reducer instead of reading it from the store.");return s}n(d,"getState");function f(m){if(typeof m!="function")throw new Error("Expected the listener to be a function.");if(l)throw new Error("You may not call store.subscribe() while the reducer is executing. If you would like to be notified after the store has been updated, subscribe from a component and invoke store.getState() in the callback to access the latest state. See https://redux.js.org/api-reference/store#subscribelistener for more details.");var E=!0;return p(),c.push(m),n(function(){if(!!E){if(l)throw new Error("You may not unsubscribe from a store listener while the reducer is executing. See https://redux.js.org/api-reference/store#subscribelistener for more details.");E=!1,p();var y=c.indexOf(m);c.splice(y,1),a=null}},"unsubscribe")}n(f,"subscribe");function h(m){if(!ec(m))throw new Error("Actions must be plain objects. Use custom middleware for async actions.");if(typeof m.type>"u")throw new Error('Actions may not have an undefined "type" property. Have you misspelled a constant?');if(l)throw new Error("Reducers may not dispatch actions.");try{l=!0,s=i(s,m)}finally{l=!1}for(var E=a=c,T=0;T<E.length;T++){var y=E[T];y()}return m}n(h,"dispatch");function _(m){if(typeof m!="function")throw new Error("Expected the nextReducer to be a function.");i=m,h({type:yt.REPLACE})}n(_,"replaceReducer");function P(){var m,E=f;return m={subscribe:n(function(y){if(typeof y!="object"||y===null)throw new TypeError("Expected the observer to be an object.");function O(){y.next&&y.next(d())}n(O,"observeState"),O();var C=E(O);return{unsubscribe:C}},"subscribe")},m[ho]=function(){return this},m}return n(P,"observable"),h({type:yt.INIT}),o={dispatch:h,subscribe:f,getState:d,replaceReducer:_},o[ho]=P,o}n(go,"createStore");function tc(t,e){var r=e&&e.type,o=r&&'action "'+String(r)+'"'||"an action";return"Given "+o+', reducer "'+t+'" returned undefined. To ignore an action, you must explicitly return the previous state. If you want this reducer to hold no value, you can return null instead of undefined.'}n(tc,"getUndefinedStateErrorMessage");function rc(t){Object.keys(t).forEach(function(e){var r=t[e],o=r(void 0,{type:yt.INIT});if(typeof o>"u")throw new Error('Reducer "'+e+`" returned undefined during initialization. If the state passed to the reducer is undefined, you must explicitly return the initial state. The initial state may not be undefined. If you don't want to set a value for this reducer, you can use null instead of undefined.`);if(typeof r(void 0,{type:yt.PROBE_UNKNOWN_ACTION()})>"u")throw new Error('Reducer "'+e+'" returned undefined when probed with a random type. '+("Don't try to handle "+yt.INIT+' or other actions in "redux/*" ')+"namespace. They are considered private. Instead, you must return the current state for any unknown actions, unless it is undefined, in which case you must return the initial state, regardless of the action type. The initial state may not be undefined, but can be null.")})}n(rc,"assertReducerShape");function Bt(t){for(var e=Object.keys(t),r={},o=0;o<e.length;o++){var i=e[o];typeof t[i]=="function"&&(r[i]=t[i])}var s=Object.keys(r),a,c;try{rc(r)}catch(l){c=l}return n(function(p,d){if(p===void 0&&(p={}),c)throw c;if(!1)var f;for(var h=!1,_={},P=0;P<s.length;P++){var m=s[P],E=r[m],T=p[m],y=E(T,d);if(typeof y>"u"){var O=tc(m,d);throw new Error(O)}_[m]=y,h=h||y!==T}return h=h||s.length!==Object.keys(p).length,h?_:p},"combination")}n(Bt,"combineReducers");function Hn(t,e){return function(){return e(t.apply(this,arguments))}}n(Hn,"bindActionCreator");function zn(t,e){if(typeof t=="function")return Hn(t,e);if(typeof t!="object"||t===null)throw new Error("bindActionCreators expected an object or a function, instead received "+(t===null?"null":typeof t)+'. Did you write "import ActionCreators from" instead of "import * as ActionCreators from"?');var r={};for(var o in t){var i=t[o];typeof i=="function"&&(r[o]=Hn(i,e))}return r}n(zn,"bindActionCreators");function oc(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}n(oc,"_defineProperty");function Bn(t,e){var r=Object.keys(t);return Object.getOwnPropertySymbols&&r.push.apply(r,Object.getOwnPropertySymbols(t)),e&&(r=r.filter(function(o){return Object.getOwnPropertyDescriptor(t,o).enumerable})),r}n(Bn,"ownKeys");function nc(t){for(var e=1;e<arguments.length;e++){var r=arguments[e]!=null?arguments[e]:{};e%2?Bn(r,!0).forEach(function(o){oc(t,o,r[o])}):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):Bn(r).forEach(function(o){Object.defineProperty(t,o,Object.getOwnPropertyDescriptor(r,o))})}return t}n(nc,"_objectSpread2");function yo(){for(var t=arguments.length,e=new Array(t),r=0;r<t;r++)e[r]=arguments[r];return e.length===0?function(o){return o}:e.length===1?e[0]:e.reduce(function(o,i){return function(){return o(i.apply(void 0,arguments))}})}n(yo,"compose");function Yn(){for(var t=arguments.length,e=new Array(t),r=0;r<t;r++)e[r]=arguments[r];return function(o){return function(){var i=o.apply(void 0,arguments),s=n(function(){throw new Error("Dispatching while constructing your middleware is not allowed. Other middleware would not be applied to this dispatch.")},"dispatch"),a={getState:i.getState,dispatch:n(function(){return s.apply(void 0,arguments)},"dispatch")},c=e.map(function(l){return l(a)});return s=yo.apply(void 0,c)(i.dispatch),nc({},i,{dispatch:s})}}}n(Yn,"applyMiddleware");function Wn(t){var e=n(function(o){var i=o.dispatch,s=o.getState;return function(a){return function(c){return typeof c=="function"?c(i,s,t):a(c)}}},"middleware");return e}n(Wn,"createThunkMiddleware");var Kn=Wn();Kn.withExtraArgument=Wn;var Jn=Kn;var zi=ae(Yt());var Zn=/^og_auth=/,ic=n((t=Zn)=>(document.cookie.split(/;\s*/).find(e=>e.match(t))||"").replace(Zn,""),"c"),Wt=n(t=>{if(typeof t=="object")return t;let e=String(t||"").split("|");return e.length===3?{sig_field:e[0],ts:parseInt(e[1],10),sig:e[2]}:null},"r"),sc=n(t=>new Promise((e,r)=>{let o=document.createElement("iframe");o.style.setProperty("display","none","important"),document.body.appendChild(o),o.onload=e,o.onerror=r,o.src=t}),"p"),ac=n(t=>(t.headers.get("content-type")||"").indexOf("application/json")!==-1,"d");function Xn(){return typeof window.og_auth<"u"?Wt(window.og_auth):null}n(Xn,"a");async function cc(t=100){return new Promise(e=>{setTimeout(()=>e(Xn()),t)})}n(cc,"f");async function ei(t,e=ic,r=sc){let o;if(o=Wt(Xn())||Wt(e()),o)return o;if(t&&typeof t=="string"){let i=await fetch(t);i.status>=200&&i.status<300&&(o=e()||await(ac(i)?i.json():Promise.resolve(r(t)).then(e)))}else o||(o=await cc());if(o=Wt(o),o)return o;throw new Error("Unauthorized")}n(ei,"u");var R="OPTIN_PRODUCT",k="OPTOUT_PRODUCT",F="PRODUCT_CHANGE_FREQUENCY",ce="PRODUCT_CHANGE_PREPAID_SHIPMENTS",$e="SET_MERCHANT_ID",q="REQUEST_OFFER",w="RECEIVE_OFFER",bt="PRODUCT_HAS_CHANGED",Ve="CREATED_SESSION_ID",Kt="SET_AUTH_URL",ti="REQUEST_AUTH",Jt="AUTHORIZE",Oe="UNAUTHORIZED",ri="REQUEST_ORDERS",Qt="RECEIVE_ORDERS",St="CART_PRODUCT_KEY_HAS_CHANGED",Zt="RECEIVE_ORDER_ITEMS",oi="FETCH_RESPONSE_ERROR",je="SET_ENVIRONMENT_LOCAL",Ge="SET_ENVIRONMENT_STAGING",He="SET_ENVIRONMENT_DEV",Be="SET_ENVIRONMENT_PROD",Xt="READY",ni="CONCLUDE_UPSELL",ii="REQUEST_CREATE_IU_ORDER",er="CREATE_ONE_TIME",si="REQUEST_CONVERT_ONE_TIME",tr="CONVERT_ONE_TIME";var ze="CHECKOUT",ai="RECEIVE_FETCH",rr="SET_LOCALE",Ye="SET_CONFIG",fe="SET_PREVIEW_STANDARD_OFFER",_t="SET_PREVIEW_UPSELL_OFFER",bo="SET_PREVIEW_PREPAID_OFFER",or="ADD_TEMPLATE",nr="SET_TEMPLATES",Te="LOCAL_STORAGE_CHANGE",he="LOCAL_STORAGE_CLEAR",ir="SET_FIRST_ORDER_PLACE_DATE",sr="SET_PRODUCT_TO_SUBSCRIBE",We="RECEIVE_PRODUCT_PLANS",D="SETUP_PRODUCT",me="SETUP_CART",le="RECEIVE_MERCHANT_SETTINGS",So="SET_EXPERIMENT_VARIANT",Ke="pdp",ci="local",ar="dev",we="staging",Ce="prod",cr="static.ordergroove.com",lr="staging.static.ordergroove.com",li="og-cart-updated";var dr=ae(xt());var Po=n((...t)=>JSON.stringify(t),"memoizeKey"),Pt=n(t=>(...e)=>fetch(...t(...e)).then(r=>r.json()),"withFetchJson"),vt=n(t=>(e,...r)=>{if(!e)throw Error("host required");let[o,i={}]=t(...r);return[`${e.replace(/\/+$/,"")}${o}`,i]},"withHost"),fr=n(t=>(e,...r)=>{if(!e)throw Error("auth required");let[o,i={}]=t(...r);return[o,{...i,headers:{Authorization:JSON.stringify(e),...i.headers}}]},"withAuth"),bi=n(t=>(...e)=>{let[r,o={}]=t(...e);return[r,{method:"POST",...o,body:JSON.stringify(o.body),headers:{"Content-type":"application/json",...o.headers}}]},"withJsonBody"),Si=n((t=[])=>(Array.isArray(t)?t:Object.entries(t)).map(([e,r])=>[e,encodeURIComponent(r)].join("=")).join("&"),"toQuery"),Bc=n(t=>JSON.stringify([].concat(t).map(e=>typeof e=="object"?e.id:e).filter(e=>e)),"toProductId"),zc=(0,dr.default)(Pt(vt((t,e,r,o="pdp",i={})=>{if(!t)throw Error("merchantId required");if(!e)throw Error("sessionId required");if(!r)throw Error("product required");let s=[["session_id",e],["page_type",1],["p",Bc(r)],["module_view",JSON.stringify(["regular"])],...Object.entries(i)];return[`/offer/${t}/${o}?${Si(s)}`]})),Po),Yc=(0,dr.default)(Pt(vt(fr((t=1,e="place")=>[`/orders/?${Si([["status",t],["ordering",e],["exclude_prepaid_orders","true"]])}`]))),Po),Wc=(0,dr.default)(Pt(vt(fr(t=>{if(!t)throw Error("orderId required");return[`/items/?order=${t}`]}))),Po),Kc=Pt(vt(fr(bi((t,e,r,o)=>{if(!t)throw Error("product required");if(!e)throw Error("order required");if(!r)throw Error("quantity required");if(r<=0)throw Error("quantity must be greater or equal than one");if(!o)throw Error("offer required");return["/items/iu/",{body:{product:t,order:e,quantity:r,offer:o}}]})))),Ot=n(t=>{if(typeof t=="object")return{...t};let[e,r]=(t||"").split(/_/).map(o=>parseInt(o,10));return e&&r&&{every:e,every_period:r}},"parseFrequency"),vo=n(t=>t.match(/^\d+_\d$/),"isFrequencyValid"),Jc=n((t,e)=>String.prototype.localeCompare.call(t&&t.split("_").reverse().join("_"),e&&e.split("_").reverse().join("_")),"compareFrequencies"),_i=n(t=>[...new Set(t&&t.split(/\s+/))].filter(vo).sort(Jc),"parseFrequenciesList");var Tt=n(t=>{if(typeof t=="object"){let{every:e,period:r,every_period:o}=t;return`${e}_${r||o}`}return typeof t=="string"?t:""},"stringifyFrequency"),Qc=Pt(vt(fr(bi((t,e,r,o)=>{if(!t)throw Error("item required");if(!e)throw Error("frequency required");let i=Ot(e);if(!i)throw Error("invalid frequency");return["/subscriptions/create_from_item/",{body:{item:t.public_id,offer:r,session_id:o,...i}}]})))),Ze={fetchOffer:zc,fetchOrders:Yc,fetchItems:Wc,createOneTime:Kc,convertOneTimeToSubscription:Qc},Ei=Ze;var Oo=wt(),A={shopify:typeof window.Shopify!="undefined",shopify_selling_plans:typeof(Oo==null?void 0:Oo.dataset.shopifySellingPlans)!="undefined"};function Zc(t,e){return t===e}n(Zc,"defaultEqualityCheck");function Xc(t,e,r){if(e===null||r===null||e.length!==r.length)return!1;for(var o=e.length,i=0;i<o;i++)if(!t(e[i],r[i]))return!1;return!0}n(Xc,"areArgumentsShallowlyEqual");function el(t){var e=arguments.length>1&&arguments[1]!==void 0?arguments[1]:Zc,r=null,o=null;return function(){return Xc(e,r,arguments)||(o=t.apply(null,arguments)),r=arguments,o}}n(el,"defaultMemoize");function tl(t){var e=Array.isArray(t[0])?t[0]:t;if(!e.every(function(o){return typeof o=="function"})){var r=e.map(function(o){return typeof o}).join(", ");throw new Error("Selector creators expect all input-selectors to be functions, "+("instead received the following types: ["+r+"]"))}return e}n(tl,"getDependencies");function rl(t){for(var e=arguments.length,r=Array(e>1?e-1:0),o=1;o<e;o++)r[o-1]=arguments[o];return function(){for(var i=arguments.length,s=Array(i),a=0;a<i;a++)s[a]=arguments[a];var c=0,l=s.pop(),p=tl(s),d=t.apply(void 0,[function(){return c++,l.apply(null,arguments)}].concat(r)),f=t(function(){for(var h=[],_=p.length,P=0;P<_;P++)h.push(p[P].apply(null,arguments));return d.apply(null,h)});return f.resultFunc=l,f.dependencies=p,f.recomputations=function(){return c},f.resetRecomputations=function(){return c=0},f}}n(rl,"createSelectorCreator");var U=rl(el);var L=ae(xt());L.default.Cache=Map;function ol(t,e){if(t===e)return!0;if(t===null||e===null||t.length!==e.length)return!1;for(let r=0;r<t.length;++r)if(t[r]!==e[r])return!1;return!0}n(ol,"arraysEqual");function nl(t,e,r){let o=Tt(r);return A.shopify_selling_plans?J(t,e,o):o}n(nl,"resolveFrequency");var I=n((t,e)=>!!(t===e||typeof t=="object"&&typeof e=="object"&&t&&e&&t.id===e.id&&(!(Array.isArray(t.components)&&Array.isArray(e.components))||ol((t.components||[]).sort(),(e.components||[]).sort()))),"isSameProduct"),Ct=n(t=>t.optedin||[],"optedinSelector"),xi=n(t=>t.optedout||[],"optedoutSelector"),To=n(t=>t.autoshipByDefault||{},"autoshipSelector"),il=n(t=>t.defaultFrequencies||{},"defaultFrequenciesSelector"),Pi=n(t=>{var e;return((e=t==null?void 0:t.config)==null?void 0:e.prepaidSellingPlans)||[]},"prepaidSellingPlansSelector"),sl=n(t=>(t==null?void 0:t.prepaidShipmentsSelected)||{},"prepaidShipmentsSelectedSelector"),ee=(0,L.default)(t=>U(Ct,xi,To,(e,r,o)=>{let i=e.find(s=>I(t,s));return i||(r.find(s=>I(t,s))?!1:t&&o[t.id]?{id:t.id}:!1)}),t=>JSON.stringify(t)),hr=(0,L.default)(t=>U(Ct,e=>{let r=e.find(o=>I(t,o));return r||!1}),t=>JSON.stringify(t)),vi=(0,L.default)(t=>U(Ct,e=>e.some(r=>I(t,r)&&r.prepaidShipments)),t=>JSON.stringify(t)),te=(0,L.default)(t=>U(sl,e=>e[t.id]||null),t=>JSON.stringify(t)),mr=(0,L.default)(t=>U(xi,e=>e.find(r=>I(t,r)))),re=(0,L.default)(t=>U(ee(t),e=>e&&"frequency"in e&&e.frequency||null),t=>JSON.stringify(t)),V=(0,L.default)(t=>U(ee(t),e=>e&&"prepaidShipments"in e&&e.prepaidShipments||null),t=>JSON.stringify(t)),j=(0,L.default)(t=>U(Pi,e=>{var o;return(((o=e[S(t)])==null?void 0:o.map(({numberShipments:i})=>i))||[]).sort((i,s)=>i-s)})),Xe=(0,L.default)(t=>U(il,K(t),(e,{frequencies:r=[],frequenciesEveryPeriod:o=[]})=>e[S(t)]&&nl(r,o,e[S(t)])||null)),et=(0,L.default)(t=>U(K(t),e=>e.frequencies)),oe=(0,L.default)(t=>U(K(t),e=>e.defaultFrequency)),K=(0,L.default)(t=>U(e=>{var r;return(r=e==null?void 0:e.config)==null?void 0:r.productFrequencies},e=>{var r;return(r=e==null?void 0:e.config)==null?void 0:r.frequencies},e=>{var r;return(r=e==null?void 0:e.config)==null?void 0:r.frequenciesEveryPeriod},e=>{var r;return(r=e==null?void 0:e.config)==null?void 0:r.frequenciesText},e=>{var r;return(r=e==null?void 0:e.config)==null?void 0:r.defaultFrequency},(e,r,o,i,s)=>e?e[S(t)]||{}:{frequencies:r,frequenciesEveryPeriod:o,frequenciesText:i,defaultFrequency:s})),Oi=n((t,e)=>U(Pi,K(t.id),(r,{frequencies:o})=>{var i;if(e){let s=S(t.id),a=(i=r[s])==null?void 0:i.find(c=>c.numberShipments===e);return a?a.sellingPlan:null}return o[0]}),"makeFrequencyForPrepaidShipmentsSelector"),wo=n(t=>t.replace(/([a-z0-9]|(?=[A-Z]))([A-Z])/g,"$1-$2").toLowerCase(),"kebabCase"),G=n((t,e,r)=>t&&t.hasAttribute&&t.hasAttribute(wo(e))&&t[e]||t.offer&&typeof(t.offer[e]!=="undefined")&&t.offer[e]||r,"getFallbackValue"),tt=n(t=>({templates:t.templates||[]}),"templatesSelector");function gr(t){document.readyState==="loading"?window.addEventListener("DOMContentLoaded",t):t()}n(gr,"onReady");function wt(){return document.querySelector([`script[src^="https://${cr}"]`,`script[src^="https://${lr}"]`,`script[src^="http://${cr}"]`,`script[src^="http://${lr}"]`].join(","))}n(wt,"getMainJs");function Co(){let t=wt();if(!t)return[];let e=new URL(t.src),r=e.host.startsWith(we)?we:Ce,o=e.pathname.split("/")[1];return!r&&!o?[]:[o,r,t]}n(Co,"resolveEnvAndMerchant");var S=n(t=>{var r;if(!t)return"";let e=`${t.id||t}`;return(r=A)!=null&&r.shopify_selling_plans&&(e=e.split(":")[0]),e},"safeProductId"),Ti=n((t,e,r)=>{if(A.shopify_selling_plans){let o=e==null?void 0:e.indexOf(t);if(o>=0&&r[o])return r[o]}return t},"safeOgFrequency"),Rt=n((t,e)=>{if(!`${t}`.includes("_"))return t;let{frequencies:r,frequenciesEveryPeriod:o}=e,i=o==null?void 0:o.indexOf(t);return i>=0&&o[i]?r[i]:(r==null?void 0:r.length)>0&&(o==null?void 0:o.length)>0?(console.warn(`Unable to find selling plan match for frequency ${t}; falling back to first selling plan`),r[0]):t},"frequencyToSellingPlan");function wi(t){if(t.isReady())return;console.info("OG offers are auto initializing");let[e,r]=Co();if(!r&&!e)return;let o=document.createElement("script");o.onload=()=>console.info("OG pull initialization chunk for merchant",e,r),o.onerror=()=>t.initialize(e,r),o.src=`${window.location.protocol}//${r===Ce?cr:lr}/${e}/main.js?initOnly=true`,document.head.appendChild(o)}n(wi,"autoInitializeOffers");var Ci=n(t=>{document.cookie=`${t}=; expires=Thu, 01 Jan 1970 00:00:01 GMT;`},"clearCookie");function Ri(t){let e=document.cookie.match(`(^|;) ?${t}=([^;]*)(;|$)`);return e?e[2]:null}n(Ri,"getCookieValue");var Ie=n(t=>!!(t&&(t==null?void 0:t.includes("_"))),"isOgFrequency"),pe=n((t=[])=>(t==null?void 0:t[0])||null,"getFirstSellingPlan"),yr=n((t=[],e=[])=>{var r;return!!(((r=A)==null?void 0:r.shopify_selling_plans)&&t.length&&e.length)},"hasShopifySellingPlans"),J=n((t,e,r)=>{if(t.length!==e.length)return null;let o=e.findIndex(i=>i===r);return o>=0?t[o]:null},"mapFrequencyToSellingPlan");function Ro(t,e,r){let o=t.querySelector(`[name="${e}"]`);if(o&&!r){o.remove();return}!o&&r&&(o=document.createElement("input"),o.type="hidden",o.name=e,t.appendChild(o)),o&&(o.value=r)}n(Ro,"getOrCreateHidden");function rt(t,e){let[[r],o]=t.reduce((i,s)=>i[I(e,s)?0:1].push(s)&&i,[[],[]]);return[r||{},o||[]]}n(rt,"getMatchingProductIfExists");var Q=n((t,e,r)=>({type:R,payload:{product:t,frequency:e,offer:r}}),"optinProduct"),ot=n((t,e)=>({type:k,payload:{product:t,offer:e}}),"optoutProduct"),Ai=n((t,e)=>({type:bt,payload:{newProduct:t,product:e}}),"productHasChangedComponents"),Sr=n((t,e,r)=>({type:F,payload:{product:t,frequency:e,offer:r}}),"productChangeFrequency"),ye=n((t,e,r)=>(o,i)=>{let s=Oi(t,e)(i());o({type:ce,payload:{product:t,prepaidShipments:e,offer:r,frequency:s}})},"productChangePrepaidShipments");var _r=n(t=>({type:ni,payload:{product:t}}),"concludeUpsell"),Ii=n(t=>({type:$e,payload:t}),"setMerchantId"),Ao=n(t=>({type:Ve,payload:`${t}.${Math.floor(Math.random()*999999)}.${Math.round(new Date().getTime()/1e3)}`}),"createSessionId"),al=n(t=>({type:ti,payload:t}),"requestAuth"),At=n((t,e,r,o)=>({type:Jt,payload:{public_id:t,sig_field:e,ts:r,sig:o}}),"authorize"),ge=n(t=>({type:Oe,payload:t}),"unauthorized"),Ni=n(t=>({type:Kt,payload:t}),"setAuthUrl"),It=n(t=>({type:ai,payload:t}),"fetchDone"),ki=n((t=ei)=>n(function(r,o){if(window.og&&window.og.previewMode)return r(ge({message:"Offers are running in preview mode"}));let{merchantId:i,authUrl:s}=o(),a=al(s);return r(a),t(s).then(({sig_field:c,ts:l,sig:p})=>r(At(i,c,l,p)),c=>r(ge(c))).finally(()=>r(It(a)))},"fetchAuthThunk"),"fetchAuth"),cl=n((t,e)=>({type:ri,payload:{status:t,ordering:e}}),"requestOrders"),Io=n(t=>({type:Qt,payload:t}),"receiveOrders"),No=n(t=>({type:Zt,payload:t}),"receiveItems"),Er=n((t=1,e="place")=>n(function(o,i){let{environment:{legoUrl:s},auth:a}=i();if(!a)return o(ge("No auth set."));let c=cl(t,e);return o(c),Ze.fetchOrders(s,a,t,e).then(l=>{if(l.results){o(Io(l));let p=(l.results[0]||{}).public_id;if(p)return Ze.fetchItems(s,a,p).then(d=>o(No(d)))}return o(ge(l.detail)),null},l=>o(ge(l))).finally(()=>o(It(c)))},"fetchOrdersThunk"),"fetchOrders"),Fi=n(t=>{switch(t){case ci:return{type:je,payload:t};case ar:return{type:He,payload:t};case we:return{type:Ge,payload:t};case Ce:return{type:Be,payload:t};default:throw new Error(`${t} is not a supported environment`)}},"setEnvironment"),qi=n(()=>(t,e)=>{let{merchantId:r,sessionId:o}=e();return(!o||r&&!o.startsWith(r))&&t(Ao(r)),o},"requestSessionId"),be=n((t,e,r)=>(o,i)=>{let s=K(r)(i());o({type:w,payload:{...t,offer:e,frequencyConfig:s}})},"receiveOffer"),br=n(t=>({type:oi,payload:t}),"fetchResponseError"),ko=n((t,e=Ke,r)=>({type:q,payload:{product:t,module:e,offer:r}}),"requestOffer"),Di=ko,Ui=n(()=>({type:ze}),"checkout"),ll=n((t,e,r,o)=>({type:ii,payload:{product:t,order:e,quantity:r,offerId:o}}),"requestCreateOneTime"),pl=n(t=>({type:er,payload:t}),"receiveCreateOneTime"),ul=n((t,e)=>({type:si,payload:{item:t,frequency:e}}),"requestConvertOneTimeToSubscription"),dl=n((t,e)=>({type:tr,payload:{response:t,product:e}}),"receiveConvertOneTime"),xr=n((t,e,r,o=!1,i=null)=>n(function(a,c){let l=c(),{auth:p,environment:{legoUrl:d},previewUpsellOffer:f,offerId:h,sessionId:_}=l;if(!p)return a(ge("No auth set."));let{frequencies:P,frequenciesEveryPeriod:m}=K(t.id)(l),E=Ti(i,P,m),T=ll(t,e,r,h);return a(T),(f?Promise.resolve({legoUrl:d,product:t,order:e,quantity:r,offer:h}):Ze.createOneTime(d,p,t.id,e,r,h)).then(y=>(a(pl(y)),o?(a(ul(y,E)),(f?Promise.resolve({item:y,frequency:E}):Ze.convertOneTimeToSubscription(d,p,y,E,h,_)).then(O=>a(dl(O,t)),O=>a(br(O)))):y),y=>a(br(y))).finally(()=>a(It(T)))},"createIuThunk"),"createIu"),Li=n(t=>({type:rr,payload:t}),"setLocale"),Mi=n(t=>({type:Ye,payload:t}),"setConfig"),$i=n((t,e,r)=>({type:or,payload:{selector:t,markup:e,config:r}}),"addTemplate"),Vi=n(t=>({type:nr,payload:t}),"setTemplates"),ji=n((t,e)=>({type:ir,payload:{product:t,firstOrderPlaceDate:e}}),"setFirstOrderPlaceDate"),Gi=n((t,e)=>({type:sr,payload:{product:t,productToSubscribe:e}}),"setProductToSubscribe"),Hi=n(t=>({type:le,payload:t}),"receiveMerchantSettings");var Nt="OG_STATE",Yi=n(t=>{try{return t===null?void 0:JSON.parse(t)}catch{return}},"safeParseState"),Fo=n(()=>window.og&&window.og.previewMode,"isPreviewMode"),Wi=n(()=>Fo()?{}:Yi(localStorage.getItem(Nt)),"loadState"),fl=n(t=>!t||!t.sessionId?!1:JSON.stringify({sessionId:t.sessionId,optedin:t.optedin,optedout:t.optedout,productOffer:t.productOffer,firstOrderPlaceDate:t.firstOrderPlaceDate,productToSubscribe:t.productToSubscribe}),"serializeState"),Ki=n(t=>{if(Fo())return;t&&t.sessionId&&(document.cookie="og_session_id="+encodeURIComponent(t.sessionId)+"; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT; SameSite=Lax");let e=fl(t);e&&localStorage.getItem(Nt)!==e&&localStorage.setItem(Nt,e)},"saveState"),Ji=n(t=>(0,zi.throttle)(500,e=>{if(Fo())return;let{key:r,newValue:o}=e;r===Nt&&o===null?(t.dispatch({type:he}),setTimeout(()=>t.dispatch(qi()),0)):r===Nt&&t.dispatch({type:Te,newValue:Yi(o)})}),"listenLocalStorageChanges");var Zi=ae(Yt());var hl=n((t,e,r=document)=>r.dispatchEvent(new CustomEvent(t,{detail:e})),"dispatchEvent"),Qi=n(t=>({payload:{product:{id:e,components:r}={}}={}}={})=>setTimeout(()=>hl("optin-changed",{productId:e,components:r,optedIn:t}),0),"dispatchOptinChangedEvent"),ml=[{expressions:[({type:t}={})=>t===R,({type:t}={})=>t===F],fn:Qi(!0)},{expressions:[({type:t}={})=>t===k],fn:Qi(!1)}],Xi=n(t=>e=>r=>{let o=t.getState();ml.forEach(i=>{i.expressions.some(s=>s(r,o))&&i.fn(r)}),e(r)},"dispatchMiddleware"),es=n(t=>e=>r=>{var i;let o;switch(r.type){case w:case k:case R:case F:o=new CustomEvent(`og-${r.type.toLowerCase().replace(/_/g,"-")}`,{bubbles:!0,cancelable:!0,detail:r.payload}),(((i=r.payload)==null?void 0:i.offer)||document).dispatchEvent(o);break;default:}o!=null&&o.defaultPrevented||e(r)},"offerEvents"),ts=n(t=>e=>r=>{e(r);let o=(0,Zi.throttle)(500,()=>{Ki({...t.getState()})});r.type!==Te&&o()},"localStorageMiddleware");var kt=n(()=>{let t,e;return[new Promise((r,o)=>{t=r,e=o}),t,e]},"waitFor");function rs(t){let[e,r]=kt(),[o,i]=kt(),[s,a]=kt();o.then(l=>{let{sessionId:p}=t.getState();!p||l&&!p.startsWith(l)?t.dispatch(Ao(l)):a(p)});let c=Promise.all([o,e,s]);return c.then(()=>{var l;t.dispatch({type:Xt,payload:{}}),window.addEventListener("storage",Ji(t)),(l=t.getState().auth)!=null&&l.ts||t.dispatch(ki())}),l=>async p=>{je===p.type||He===p.type||Ge===p.type||Be===p.type?r(p.payload):$e===p.type?i(p.payload):Ve===p.type?a(p.payload):await c,l(p)}}n(rs,"waitUntilOffersReady");function os(t){return e=>r=>{if(r.type===q){let{merchantId:o,sessionId:i,environment:{apiUrl:s}}=t.getState(),a=S(r.payload.product);a&&Ei.fetchOffer(s,o,i,a,r.payload.module||Ke,r.payload.searchParams).then(c=>t.dispatch(be(c,r.payload.offer,a)),c=>t.dispatch(br(c))).finally(()=>t.dispatch(It(r)))}return e(r)}}n(os,"offerRequestMiddleware");var ds=ae(as());var ue=n((t,e)=>t===null?"":new Intl.NumberFormat(navigator.language,{style:"currency",currency:e}).format(t/100),"money"),vr=n(t=>`${t}%`,"percentage"),Sl="Subscribe and Save",_l="ordergroove-subscribe-and-save-",Ft=n((t=[])=>t.find(ps)||t.find(ls)||t.find(Or),"getPayAsYouGoSellingPlanGroup"),cs=n((t=[])=>t.filter(e=>ls(e)||ps(e)||Or(e)),"getPayAsYouGoSellingPlanGroups"),ls=n(t=>t.name===Sl||t.app_id==="ordergroove-subscribe-and-save","isDefaultSellingPlanGroup"),ps=n(t=>t.name.startsWith("og_psfl")||t.app_id==="ordergroove-product-specific-frequency-list","isProductSpecificFrequencySellingPlanGroup"),Or=n(t=>{var e;return(e=t.app_id)==null?void 0:e.startsWith(_l)},"isExperimentSellingPlanGroup"),us=n(t=>{let e=Ft(t.map(r=>r.group));return t.find(r=>r.group===e)},"getPayAsYouGoSellingPlan");function Tr(t){var e;return(e=t==null?void 0:t.selling_plans)==null?void 0:e.map(({id:r})=>`${r}`)}n(Tr,"sellingPlansToFrequencies");function wr(t){var e;return(e=t==null?void 0:t.selling_plans)==null?void 0:e.map(({options:r})=>r||[]).flat().map(({value:r})=>El(r))}n(wr,"sellingPlansToEveryPeriod");function El(t){let e=["day","week","month"].findIndex(o=>t.toLowerCase().includes(o))+1,r=(t.match(/(\d+)/)||["",1])[1];return r&&e?`${r}_${e}`:null}n(El,"textToFreq");function Cr(t){var r;let e=(r=t==null?void 0:t.options.find(({name:o})=>o==="Shipment amount"))==null?void 0:r.value.split(" ")[0];return e?Number(e):void 0}n(Cr,"getPrepaidShipments");function xl(t,e){e.map(a=>a.weight).reduce((a,c)=>a+c,0)!==100&&console.error("OG: Sum of weights for variants must be 100. Defaulting to last variant.");let i=ds.default.murmur3(t,0)%100,s=0;for(let a=0;a<e.length;a++){let c=e[a],l=s+c.weight;if(c.weight>0&&i<l)return a;s=l}return e.length-1}n(xl,"getVariantIx");function Rr(t={},e){var r;switch(e.type){case le:return{...t,...e.payload.experiments};case So:return{...t,currentVariant:e.payload.index,offerProfileId:(r=e.payload.parameters)==null?void 0:r.offer_profile_public_id};default:return t}}n(Rr,"experimentsReducer");function Pl(t,e,r){if(!t||r.variants.length===0)return;let o=e.selling_plan_groups.filter(Or);if(o.length!==r.variants.length)return;let i=o.find(({app_id:s})=>s.endsWith(t.public_id));if(!!i)return{...e,selling_plan_groups:[i],variants:e.variants.map(({selling_plan_allocations:s,...a})=>({...a,selling_plan_allocations:s.filter(({selling_plan_group_id:c})=>c===i.id)}))}}n(Pl,"resolveShopifySetupProductWhenExperiment");function vl(t,e){let r=t==null?void 0:t.public_id;if(!r)return null;let o=t.variants,i=xl(`${r}|${e}`,o);return{...o[i],index:i}}n(vl,"getAssignedExperimentVariant");function fs(t){let[e,r]=kt(),o,i;return s=>async a=>{if(a.type===Xt)r();else if(a.type===le){await e,i=a.payload.experiments;let{sessionId:c}=t.getState();o=vl(i,c),o&&t.dispatch({type:So,payload:o})}else if(a.type===q)await e,o&&(a.payload.searchParams={...a.payload.searchParams,variant:o.public_id});else if(a.type===D){await e;let c=Pl(o,a.payload.product,i);if(c)return s({type:D,payload:{...a.payload,experiments:!0,originalPayload:a.payload,product:c}})}return s(a)}}n(fs,"experimentsMiddleware");function hs(t,...e){if(window.og&&window.og.store)return window.og.store;let r=window.og&&window.og.previewMode,o=typeof window=="object"&&window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__?window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__({name:"Ordergroove Offers"}):yo,i=[rs,Jn,fs,os,Xi,es],s={};if(!r)try{s=Wi(),i.push(ts)}catch{}let a=o(Yn(...i,...e.filter(l=>l))),c=go(t,s,a);return window.og=window.og||{},window.og.store=c,c}n(hs,"makeStore");var Ol=Object.defineProperty,Ar=n((t,e)=>Ol(t,"name",{value:e,configurable:!0}),"i"),Tl=Ar(t=>e=>t.indexOf(e.origin)>=0,"createIsMessageAllowed"),gs=["https://rc3.ordergroove.com","https://rc3.stg.ordergroove.com","https://rc3-beta.stg.ordergroove.com","http://localhost:3000","http://localhost:3010","http://0.0.0.0:3010",window.location.origin],ms=Ar(t=>(e,r)=>{gs.forEach(o=>t.postMessage({ogType:e,...r},o))},"createBroadcastMessage");function Uo(t=window.opener,e=window.og){let r=Ar(o=>{let i=Tl(gs),s=ms(o.source),a=o.data.options||{};if(i(o)&&o.data.ogType==="READY"){let c="//static.ordergroove.com/@ordergroove/offers-live-editor/0.6.9/dist/";c.startsWith("//")&&(c=window.location.protocol+c),c.endsWith("/")||(c+="/"),import(`${c}client.js`).then(({initializeClient:l})=>{l({isMessageAllowed:i,broadcastMessage:s,options:a,og:e}),window.removeEventListener("message",r)})}},"handleReady");t&&t!==window&&(window.addEventListener("message",r),ms(t)("READY"))}n(Uo,"h");Ar(Uo,"offersLiveEditor");var Ir=null,wl=n(t=>({dispatch:t}),"defaultMapDispatchToProps"),ys=n(t=>{if(!Ir)throw new Error("Missing redux store.");return Ir},"resolveStore"),Cl=n((t,e)=>r=>{let{getState:o,dispatch:i}=ys(r),s=t?t(o(),r):{},a=e(i,r);Object.assign(r,s,a)},"createRecalcProps"),g=n((t,e=wl)=>r=>{let i=Cl(t,typeof e=="function"?e:s=>zn(e,s));return class extends r{get store(){return Ir}connectedCallback(){super.connectedCallback&&super.connectedCallback(),this._storeUnsubscribe=ys(this).subscribe(()=>i(this)),i(this)}attributeChangedCallback(s,a,c){super.attributeChangedCallback&&super.attributeChangedCallback(s,a,c),this._storeUnsubscribe&&a!==c&&i(this)}disconnectedCallback(){this._storeUnsubscribe(),super.disconnectedCallback&&super.disconnectedCallback()}}},"connect"),bs=n(t=>{Ir=t},"setStore");var Lo=n((t={},e=[])=>(t.optedin||[]).map(r=>{let o={product:r.id,subscription_info:{components:r.components||[]},tracking_override:{offer:((t.productOffer||{})[r.id]||[])[0],...t.sessionId&&{session_id:t.sessionId},...Ot(r.frequency)}};return t.firstOrderPlaceDate&&t.firstOrderPlaceDate[r.id]&&(o.subscription_info.first_order_place_date=t.firstOrderPlaceDate[r.id]),t.productToSubscribe&&t.productToSubscribe[r.id]&&(o.tracking_override.product=t.productToSubscribe[r.id]),o}).filter(r=>r.tracking_override.offer).filter(r=>e.length?e.includes(r.product):r),"getProductsForPurchasePost"),Nr=n((t={})=>{let e={};return Object.entries(t).forEach(([r,o])=>{Object.entries(o).forEach(([i,s])=>{let a={};s&&!Array.isArray(s)?a=s:a={frequency:i,prepaidShipments:null,regularPrice:s[0],subscriptionPrice:s[2],discountRate:s[1]},e[r]?e[r].push(a):e[r]=[a]})}),e},"getObjectStructuredProductPlans");var Mo=typeof window<"u"&&window.customElements!=null&&window.customElements.polyfillWrapFlushCallback!==void 0;var Ne=n((t,e,r=null)=>{for(;e!==r;){let o=e.nextSibling;t.removeChild(e),e=o}},"removeNodes");var H=`{{lit-${String(Math.random()).slice(2)}}}`,$o=`<!--${H}-->`,Ss=new RegExp(`${H}|${$o}`),nt="$lit$",Se=class{constructor(e,r){this.parts=[],this.element=r;let o=[],i=[],s=document.createTreeWalker(r.content,133,null,!1),a=0,c=-1,l=0,{strings:p,values:{length:d}}=e;for(;l<d;){let f=s.nextNode();if(f===null){s.currentNode=i.pop();continue}if(c++,f.nodeType===1){if(f.hasAttributes()){let h=f.attributes,{length:_}=h,P=0;for(let m=0;m<_;m++)_s(h[m].name,nt)&&P++;for(;P-- >0;){let m=p[l],E=kr.exec(m)[2],T=E.toLowerCase()+nt,y=f.getAttribute(T);f.removeAttribute(T);let O=y.split(Ss);this.parts.push({type:"attribute",index:c,name:E,strings:O}),l+=O.length-1}}f.tagName==="TEMPLATE"&&(i.push(f),s.currentNode=f.content)}else if(f.nodeType===3){let h=f.data;if(h.indexOf(H)>=0){let _=f.parentNode,P=h.split(Ss),m=P.length-1;for(let E=0;E<m;E++){let T,y=P[E];if(y==="")T=ne();else{let O=kr.exec(y);O!==null&&_s(O[2],nt)&&(y=y.slice(0,O.index)+O[1]+O[2].slice(0,-nt.length)+O[3]),T=document.createTextNode(y)}_.insertBefore(T,f),this.parts.push({type:"node",index:++c})}P[m]===""?(_.insertBefore(ne(),f),o.push(f)):f.data=P[m],l+=m}}else if(f.nodeType===8)if(f.data===H){let h=f.parentNode;(f.previousSibling===null||c===a)&&(c++,h.insertBefore(ne(),f)),a=c,this.parts.push({type:"node",index:c}),f.nextSibling===null?f.data="":(o.push(f),c--),l++}else{let h=-1;for(;(h=f.data.indexOf(H,h+1))!==-1;)this.parts.push({type:"node",index:-1}),l++}}for(let f of o)f.parentNode.removeChild(f)}};n(Se,"Template");var _s=n((t,e)=>{let r=t.length-e.length;return r>=0&&t.slice(r)===e},"endsWith"),qt=n(t=>t.index!==-1,"isTemplatePartActive"),ne=n(()=>document.createComment(""),"createMarker"),kr=/([ \x09\x0a\x0c\x0d])([^\0-\x1F\x7F-\x9F "'>=/]+)([ \x09\x0a\x0c\x0d]*=[ \x09\x0a\x0c\x0d]*(?:[^ \x09\x0a\x0c\x0d"'`<>=]*|"[^"]*|'[^']*))$/;var Vo=133;function jo(t,e){let{element:{content:r},parts:o}=t,i=document.createTreeWalker(r,Vo,null,!1),s=Dt(o),a=o[s],c=-1,l=0,p=[],d=null;for(;i.nextNode();){c++;let f=i.currentNode;for(f.previousSibling===d&&(d=null),e.has(f)&&(p.push(f),d===null&&(d=f)),d!==null&&l++;a!==void 0&&a.index===c;)a.index=d!==null?-1:a.index-l,s=Dt(o,s),a=o[s]}p.forEach(f=>f.parentNode.removeChild(f))}n(jo,"removeNodesFromTemplate");var Al=n(t=>{let e=t.nodeType===11?0:1,r=document.createTreeWalker(t,Vo,null,!1);for(;r.nextNode();)e++;return e},"countNodes"),Dt=n((t,e=-1)=>{for(let r=e+1;r<t.length;r++){let o=t[r];if(qt(o))return r}return-1},"nextActiveIndexInTemplateParts");function Es(t,e,r=null){let{element:{content:o},parts:i}=t;if(r==null){o.appendChild(e);return}let s=document.createTreeWalker(o,Vo,null,!1),a=Dt(i),c=0,l=-1;for(;s.nextNode();)for(l++,s.currentNode===r&&(c=Al(e),r.parentNode.insertBefore(e,r));a!==-1&&i[a].index===l;){if(c>0){for(;a!==-1;)i[a].index+=c,a=Dt(i,a);return}a=Dt(i,a)}}n(Es,"insertNodeIntoTemplate");var xs=new WeakMap,Go=n(t=>(...e)=>{let r=t(...e);return xs.set(r,!0),r},"directive"),ke=n(t=>typeof t=="function"&&xs.has(t),"isDirective");var M={},Fr={};var de=class{constructor(e,r,o){this.__parts=[],this.template=e,this.processor=r,this.options=o}update(e){let r=0;for(let o of this.__parts)o!==void 0&&o.setValue(e[r]),r++;for(let o of this.__parts)o!==void 0&&o.commit()}_clone(){let e=Mo?this.template.element.content.cloneNode(!0):document.importNode(this.template.element.content,!0),r=[],o=this.template.parts,i=document.createTreeWalker(e,133,null,!1),s=0,a=0,c,l=i.nextNode();for(;s<o.length;){if(c=o[s],!qt(c)){this.__parts.push(void 0),s++;continue}for(;a<c.index;)a++,l.nodeName==="TEMPLATE"&&(r.push(l),i.currentNode=l.content),(l=i.nextNode())===null&&(i.currentNode=r.pop(),l=i.nextNode());if(c.type==="node"){let p=this.processor.handleTextExpression(this.options);p.insertAfterNode(l.previousSibling),this.__parts.push(p)}else this.__parts.push(...this.processor.handleAttributeExpressions(l,c.name,c.strings,this.options));s++}return Mo&&(document.adoptNode(e),customElements.upgrade(e)),e}};n(de,"TemplateInstance");var Ps=window.trustedTypes&&trustedTypes.createPolicy("lit-html",{createHTML:t=>t}),Nl=` ${H} `,ie=class{constructor(e,r,o,i){this.strings=e,this.values=r,this.type=o,this.processor=i}getHTML(){let e=this.strings.length-1,r="",o=!1;for(let i=0;i<e;i++){let s=this.strings[i],a=s.lastIndexOf("<!--");o=(a>-1||o)&&s.indexOf("-->",a+1)===-1;let c=kr.exec(s);c===null?r+=s+(o?Nl:$o):r+=s.substr(0,c.index)+c[1]+c[2]+nt+c[3]+H}return r+=this.strings[e],r}getTemplateElement(){let e=document.createElement("template"),r=this.getHTML();return Ps!==void 0&&(r=Ps.createHTML(r)),e.innerHTML=r,e}};n(ie,"TemplateResult");var Dr=n(t=>t===null||!(typeof t=="object"||typeof t=="function"),"isPrimitive"),qr=n(t=>Array.isArray(t)||!!(t&&t[Symbol.iterator]),"isIterable"),Fe=class{constructor(e,r,o){this.dirty=!0,this.element=e,this.name=r,this.strings=o,this.parts=[];for(let i=0;i<o.length-1;i++)this.parts[i]=this._createPart()}_createPart(){return new _e(this)}_getValue(){let e=this.strings,r=e.length-1,o=this.parts;if(r===1&&e[0]===""&&e[1]===""){let s=o[0].value;if(typeof s=="symbol")return String(s);if(typeof s=="string"||!qr(s))return s}let i="";for(let s=0;s<r;s++){i+=e[s];let a=o[s];if(a!==void 0){let c=a.value;if(Dr(c)||!qr(c))i+=typeof c=="string"?c:String(c);else for(let l of c)i+=typeof l=="string"?l:String(l)}}return i+=e[r],i}commit(){this.dirty&&(this.dirty=!1,this.element.setAttribute(this.name,this._getValue()))}};n(Fe,"AttributeCommitter");var _e=class{constructor(e){this.value=void 0,this.committer=e}setValue(e){e!==M&&(!Dr(e)||e!==this.value)&&(this.value=e,ke(e)||(this.committer.dirty=!0))}commit(){for(;ke(this.value);){let e=this.value;this.value=M,e(this)}this.value!==M&&this.committer.commit()}};n(_e,"AttributePart");var se=class{constructor(e){this.value=void 0,this.__pendingValue=void 0,this.options=e}appendInto(e){this.startNode=e.appendChild(ne()),this.endNode=e.appendChild(ne())}insertAfterNode(e){this.startNode=e,this.endNode=e.nextSibling}appendIntoPart(e){e.__insert(this.startNode=ne()),e.__insert(this.endNode=ne())}insertAfterPart(e){e.__insert(this.startNode=ne()),this.endNode=e.endNode,e.endNode=this.startNode}setValue(e){this.__pendingValue=e}commit(){if(this.startNode.parentNode===null)return;for(;ke(this.__pendingValue);){let r=this.__pendingValue;this.__pendingValue=M,r(this)}let e=this.__pendingValue;e!==M&&(Dr(e)?e!==this.value&&this.__commitText(e):e instanceof ie?this.__commitTemplateResult(e):e instanceof Node?this.__commitNode(e):qr(e)?this.__commitIterable(e):e===Fr?(this.value=Fr,this.clear()):this.__commitText(e))}__insert(e){this.endNode.parentNode.insertBefore(e,this.endNode)}__commitNode(e){this.value!==e&&(this.clear(),this.__insert(e),this.value=e)}__commitText(e){let r=this.startNode.nextSibling;e=e??"";let o=typeof e=="string"?e:String(e);r===this.endNode.previousSibling&&r.nodeType===3?r.data=o:this.__commitNode(document.createTextNode(o)),this.value=e}__commitTemplateResult(e){let r=this.options.templateFactory(e);if(this.value instanceof de&&this.value.template===r)this.value.update(e.values);else{let o=new de(r,e.processor,this.options),i=o._clone();o.update(e.values),this.__commitNode(i),this.value=o}}__commitIterable(e){Array.isArray(this.value)||(this.value=[],this.clear());let r=this.value,o=0,i;for(let s of e)i=r[o],i===void 0&&(i=new se(this.options),r.push(i),o===0?i.appendIntoPart(this):i.insertAfterPart(r[o-1])),i.setValue(s),i.commit(),o++;o<r.length&&(r.length=o,this.clear(i&&i.endNode))}clear(e=this.startNode){Ne(this.startNode.parentNode,e.nextSibling,this.endNode)}};n(se,"NodePart");var it=class{constructor(e,r,o){if(this.value=void 0,this.__pendingValue=void 0,o.length!==2||o[0]!==""||o[1]!=="")throw new Error("Boolean attributes can only contain a single expression");this.element=e,this.name=r,this.strings=o}setValue(e){this.__pendingValue=e}commit(){for(;ke(this.__pendingValue);){let r=this.__pendingValue;this.__pendingValue=M,r(this)}if(this.__pendingValue===M)return;let e=!!this.__pendingValue;this.value!==e&&(e?this.element.setAttribute(this.name,""):this.element.removeAttribute(this.name),this.value=e),this.__pendingValue=M}};n(it,"BooleanAttributePart");var st=class extends Fe{constructor(e,r,o){super(e,r,o),this.single=o.length===2&&o[0]===""&&o[1]===""}_createPart(){return new Ut(this)}_getValue(){return this.single?this.parts[0].value:super._getValue()}commit(){this.dirty&&(this.dirty=!1,this.element[this.name]=this._getValue())}};n(st,"PropertyCommitter");var Ut=class extends _e{};n(Ut,"PropertyPart");var vs=!1;(()=>{try{let t={get capture(){return vs=!0,!1}};window.addEventListener("test",t,t),window.removeEventListener("test",t,t)}catch{}})();var at=class{constructor(e,r,o){this.value=void 0,this.__pendingValue=void 0,this.element=e,this.eventName=r,this.eventContext=o,this.__boundHandleEvent=i=>this.handleEvent(i)}setValue(e){this.__pendingValue=e}commit(){for(;ke(this.__pendingValue);){let s=this.__pendingValue;this.__pendingValue=M,s(this)}if(this.__pendingValue===M)return;let e=this.__pendingValue,r=this.value,o=e==null||r!=null&&(e.capture!==r.capture||e.once!==r.once||e.passive!==r.passive),i=e!=null&&(r==null||o);o&&this.element.removeEventListener(this.eventName,this.__boundHandleEvent,this.__options),i&&(this.__options=kl(e),this.element.addEventListener(this.eventName,this.__boundHandleEvent,this.__options)),this.value=e,this.__pendingValue=M}handleEvent(e){typeof this.value=="function"?this.value.call(this.eventContext||this.element,e):this.value.handleEvent(e)}};n(at,"EventPart");var kl=n(t=>t&&(vs?{capture:t.capture,passive:t.passive,once:t.once}:t.capture),"getOptions");function Ho(t){let e=qe.get(t.type);e===void 0&&(e={stringsArray:new WeakMap,keyString:new Map},qe.set(t.type,e));let r=e.stringsArray.get(t.strings);if(r!==void 0)return r;let o=t.strings.join(H);return r=e.keyString.get(o),r===void 0&&(r=new Se(t,t.getTemplateElement()),e.keyString.set(o,r)),e.stringsArray.set(t.strings,r),r}n(Ho,"templateFactory");var qe=new Map;var Ee=new WeakMap,Bo=n((t,e,r)=>{let o=Ee.get(e);o===void 0&&(Ne(e,e.firstChild),Ee.set(e,o=new se(Object.assign({templateFactory:Ho},r))),o.appendInto(e)),o.setValue(t),o.commit()},"render");var Lt=class{handleAttributeExpressions(e,r,o,i){let s=r[0];return s==="."?new st(e,r.slice(1),o).parts:s==="@"?[new at(e,r.slice(1),i.eventContext)]:s==="?"?[new it(e,r.slice(1),o)]:new Fe(e,r,o).parts}handleTextExpression(e){return new se(e)}};n(Lt,"DefaultTemplateProcessor");var zo=new Lt;typeof window<"u"&&(window.litHtmlVersions||(window.litHtmlVersions=[])).push("1.3.0");var u=n((t,...e)=>new ie(t,e,"html",zo),"html");var Ts=n((t,e)=>`${t}--${e}`,"getTemplateCacheKey"),Ur=!0;typeof window.ShadyCSS>"u"?Ur=!1:typeof window.ShadyCSS.prepareTemplateDom>"u"&&(console.warn("Incompatible ShadyCSS version detected. Please update to at least @webcomponents/webcomponentsjs@2.0.2 and @webcomponents/shadycss@1.3.1."),Ur=!1);var ql=n(t=>e=>{let r=Ts(e.type,t),o=qe.get(r);o===void 0&&(o={stringsArray:new WeakMap,keyString:new Map},qe.set(r,o));let i=o.stringsArray.get(e.strings);if(i!==void 0)return i;let s=e.strings.join(H);if(i=o.keyString.get(s),i===void 0){let a=e.getTemplateElement();Ur&&window.ShadyCSS.prepareTemplateDom(a,t),i=new Se(e,a),o.keyString.set(s,i)}return o.stringsArray.set(e.strings,i),i},"shadyTemplateFactory"),Dl=["html","svg"],Ul=n(t=>{Dl.forEach(e=>{let r=qe.get(Ts(e,t));r!==void 0&&r.keyString.forEach(o=>{let{element:{content:i}}=o,s=new Set;Array.from(i.querySelectorAll("style")).forEach(a=>{s.add(a)}),jo(o,s)})})},"removeStylesFromLitTemplates"),ws=new Set,Ll=n((t,e,r)=>{ws.add(t);let o=r?r.element:document.createElement("template"),i=e.querySelectorAll("style"),{length:s}=i;if(s===0){window.ShadyCSS.prepareTemplateStyles(o,t);return}let a=document.createElement("style");for(let p=0;p<s;p++){let d=i[p];d.parentNode.removeChild(d),a.textContent+=d.textContent}Ul(t);let c=o.content;r?Es(r,a,c.firstChild):c.insertBefore(a,c.firstChild),window.ShadyCSS.prepareTemplateStyles(o,t);let l=c.querySelector("style");if(window.ShadyCSS.nativeShadow&&l!==null)e.insertBefore(l.cloneNode(!0),e.firstChild);else if(r){c.insertBefore(a,c.firstChild);let p=new Set;p.add(a),jo(r,p)}},"prepareTemplateStyles"),Cs=n((t,e,r)=>{if(!r||typeof r!="object"||!r.scopeName)throw new Error("The `scopeName` option is required.");let o=r.scopeName,i=Ee.has(e),s=Ur&&e.nodeType===11&&!!e.host,a=s&&!ws.has(o),c=a?document.createDocumentFragment():e;if(Bo(t,c,Object.assign({templateFactory:ql(o)},r)),a){let l=Ee.get(c);Ee.delete(c);let p=l.value instanceof de?l.value.template:void 0;Ll(o,c,p),Ne(e,e.firstChild),e.appendChild(c),Ee.set(e,l)}!i&&s&&window.ShadyCSS.styleElement(e.host)},"render");var Rs;window.JSCompiler_renameProperty=(t,e)=>t;var Zo={toAttribute(t,e){switch(e){case Boolean:return t?"":null;case Object:case Array:return t==null?t:JSON.stringify(t)}return t},fromAttribute(t,e){switch(e){case Boolean:return t!==null;case Number:return t===null?null:Number(t);case Object:case Array:return JSON.parse(t)}return t}},As=n((t,e)=>e!==t&&(e===e||t===t),"notEqual"),Yo={attribute:!0,type:String,converter:Zo,reflect:!1,hasChanged:As},Wo=1,Ko=1<<2,Jo=1<<3,Qo=1<<4,Xo="finalized",ct=class extends HTMLElement{constructor(){super(),this.initialize()}static get observedAttributes(){this.finalize();let e=[];return this._classProperties.forEach((r,o)=>{let i=this._attributeNameForProperty(o,r);i!==void 0&&(this._attributeToPropertyMap.set(i,o),e.push(i))}),e}static _ensureClassProperties(){if(!this.hasOwnProperty(JSCompiler_renameProperty("_classProperties",this))){this._classProperties=new Map;let e=Object.getPrototypeOf(this)._classProperties;e!==void 0&&e.forEach((r,o)=>this._classProperties.set(o,r))}}static createProperty(e,r=Yo){if(this._ensureClassProperties(),this._classProperties.set(e,r),r.noAccessor||this.prototype.hasOwnProperty(e))return;let o=typeof e=="symbol"?Symbol():`__${e}`,i=this.getPropertyDescriptor(e,o,r);i!==void 0&&Object.defineProperty(this.prototype,e,i)}static getPropertyDescriptor(e,r,o){return{get(){return this[r]},set(i){let s=this[e];this[r]=i,this.requestUpdateInternal(e,s,o)},configurable:!0,enumerable:!0}}static getPropertyOptions(e){return this._classProperties&&this._classProperties.get(e)||Yo}static finalize(){let e=Object.getPrototypeOf(this);if(e.hasOwnProperty(Xo)||e.finalize(),this[Xo]=!0,this._ensureClassProperties(),this._attributeToPropertyMap=new Map,this.hasOwnProperty(JSCompiler_renameProperty("properties",this))){let r=this.properties,o=[...Object.getOwnPropertyNames(r),...typeof Object.getOwnPropertySymbols=="function"?Object.getOwnPropertySymbols(r):[]];for(let i of o)this.createProperty(i,r[i])}}static _attributeNameForProperty(e,r){let o=r.attribute;return o===!1?void 0:typeof o=="string"?o:typeof e=="string"?e.toLowerCase():void 0}static _valueHasChanged(e,r,o=As){return o(e,r)}static _propertyValueFromAttribute(e,r){let o=r.type,i=r.converter||Zo,s=typeof i=="function"?i:i.fromAttribute;return s?s(e,o):e}static _propertyValueToAttribute(e,r){if(r.reflect===void 0)return;let o=r.type,i=r.converter;return(i&&i.toAttribute||Zo.toAttribute)(e,o)}initialize(){this._updateState=0,this._updatePromise=new Promise(e=>this._enableUpdatingResolver=e),this._changedProperties=new Map,this._saveInstanceProperties(),this.requestUpdateInternal()}_saveInstanceProperties(){this.constructor._classProperties.forEach((e,r)=>{if(this.hasOwnProperty(r)){let o=this[r];delete this[r],this._instanceProperties||(this._instanceProperties=new Map),this._instanceProperties.set(r,o)}})}_applyInstanceProperties(){this._instanceProperties.forEach((e,r)=>this[r]=e),this._instanceProperties=void 0}connectedCallback(){this.enableUpdating()}enableUpdating(){this._enableUpdatingResolver!==void 0&&(this._enableUpdatingResolver(),this._enableUpdatingResolver=void 0)}disconnectedCallback(){}attributeChangedCallback(e,r,o){r!==o&&this._attributeToProperty(e,o)}_propertyToAttribute(e,r,o=Yo){let i=this.constructor,s=i._attributeNameForProperty(e,o);if(s!==void 0){let a=i._propertyValueToAttribute(r,o);if(a===void 0)return;this._updateState=this._updateState|Jo,a==null?this.removeAttribute(s):this.setAttribute(s,a),this._updateState=this._updateState&~Jo}}_attributeToProperty(e,r){if(this._updateState&Jo)return;let o=this.constructor,i=o._attributeToPropertyMap.get(e);if(i!==void 0){let s=o.getPropertyOptions(i);this._updateState=this._updateState|Qo,this[i]=o._propertyValueFromAttribute(r,s),this._updateState=this._updateState&~Qo}}requestUpdateInternal(e,r,o){let i=!0;if(e!==void 0){let s=this.constructor;o=o||s.getPropertyOptions(e),s._valueHasChanged(this[e],r,o.hasChanged)?(this._changedProperties.has(e)||this._changedProperties.set(e,r),o.reflect===!0&&!(this._updateState&Qo)&&(this._reflectingProperties===void 0&&(this._reflectingProperties=new Map),this._reflectingProperties.set(e,o))):i=!1}!this._hasRequestedUpdate&&i&&(this._updatePromise=this._enqueueUpdate())}requestUpdate(e,r){return this.requestUpdateInternal(e,r),this.updateComplete}async _enqueueUpdate(){this._updateState=this._updateState|Ko;try{await this._updatePromise}catch{}let e=this.performUpdate();return e!=null&&await e,!this._hasRequestedUpdate}get _hasRequestedUpdate(){return this._updateState&Ko}get hasUpdated(){return this._updateState&Wo}performUpdate(){if(!this._hasRequestedUpdate)return;this._instanceProperties&&this._applyInstanceProperties();let e=!1,r=this._changedProperties;try{e=this.shouldUpdate(r),e?this.update(r):this._markUpdated()}catch(o){throw e=!1,this._markUpdated(),o}e&&(this._updateState&Wo||(this._updateState=this._updateState|Wo,this.firstUpdated(r)),this.updated(r))}_markUpdated(){this._changedProperties=new Map,this._updateState=this._updateState&~Ko}get updateComplete(){return this._getUpdateComplete()}_getUpdateComplete(){return this._updatePromise}shouldUpdate(e){return!0}update(e){this._reflectingProperties!==void 0&&this._reflectingProperties.size>0&&(this._reflectingProperties.forEach((r,o)=>this._propertyToAttribute(o,this[o],r)),this._reflectingProperties=void 0),this._markUpdated()}updated(e){}firstUpdated(e){}};n(ct,"UpdatingElement");Rs=Xo;ct[Rs]=!0;var Is=Element.prototype,Wf=Is.msMatchesSelector||Is.webkitMatchesSelector;var Lr=window.ShadowRoot&&(window.ShadyCSS===void 0||window.ShadyCSS.nativeShadow)&&"adoptedStyleSheets"in Document.prototype&&"replace"in CSSStyleSheet.prototype,en=Symbol(),lt=class{constructor(e,r){if(r!==en)throw new Error("CSSResult is not constructable. Use `unsafeCSS` or `css` instead.");this.cssText=e}get styleSheet(){return this._styleSheet===void 0&&(Lr?(this._styleSheet=new CSSStyleSheet,this._styleSheet.replaceSync(this.cssText)):this._styleSheet=null),this._styleSheet}toString(){return this.cssText}};n(lt,"CSSResult");var Ns=n(t=>new lt(String(t),en),"unsafeCSS"),Ml=n(t=>{if(t instanceof lt)return t.cssText;if(typeof t=="number")return t;throw new Error(`Value passed to 'css' function must be a 'css' function result: ${t}. Use 'unsafeCSS' to pass non-literal values, but
            take care to ensure page security.`)},"textFromCSSResult"),b=n((t,...e)=>{let r=e.reduce((o,i,s)=>o+Ml(i)+t[s+1],t[0]);return new lt(r,en)},"css");(window.litElementVersions||(window.litElementVersions=[])).push("2.4.0");var ks={},x=class extends ct{static getStyles(){return this.styles}static _getUniqueStyles(){if(this.hasOwnProperty(JSCompiler_renameProperty("_styles",this)))return;let e=this.getStyles();if(Array.isArray(e)){let r=n((s,a)=>s.reduceRight((c,l)=>Array.isArray(l)?r(l,c):(c.add(l),c),a),"addStyles"),o=r(e,new Set),i=[];o.forEach(s=>i.unshift(s)),this._styles=i}else this._styles=e===void 0?[]:[e];this._styles=this._styles.map(r=>{if(r instanceof CSSStyleSheet&&!Lr){let o=Array.prototype.slice.call(r.cssRules).reduce((i,s)=>i+s.cssText,"");return Ns(o)}return r})}initialize(){super.initialize(),this.constructor._getUniqueStyles(),this.renderRoot=this.createRenderRoot(),window.ShadowRoot&&this.renderRoot instanceof window.ShadowRoot&&this.adoptStyles()}createRenderRoot(){return this.attachShadow({mode:"open"})}adoptStyles(){let e=this.constructor._styles;e.length!==0&&(window.ShadyCSS!==void 0&&!window.ShadyCSS.nativeShadow?window.ShadyCSS.ScopingShim.prepareAdoptedCssText(e.map(r=>r.cssText),this.localName):Lr?this.renderRoot.adoptedStyleSheets=e.map(r=>r instanceof CSSStyleSheet?r:r.styleSheet):this._needsShimAdoptedStyleSheets=!0)}connectedCallback(){super.connectedCallback(),this.hasUpdated&&window.ShadyCSS!==void 0&&window.ShadyCSS.styleElement(this)}update(e){let r=this.render();super.update(e),r!==ks&&this.constructor.render(r,this.renderRoot,{scopeName:this.localName,eventContext:this}),this._needsShimAdoptedStyleSheets&&(this._needsShimAdoptedStyleSheets=!1,this.constructor._styles.forEach(o=>{let i=document.createElement("style");i.textContent=o.cssText,this.renderRoot.appendChild(i)}))}render(){return ks}};n(x,"LitElement");x.finalized=!0;x.render=Cs;var Qs=ae(Hs());var zl=n(t=>{let e=String(t||"").trim().match(/(\d+)\s*([dwm])/);return e?`${e[1]}_${{d:1,w:2,m:3}[e[2]]}`:t},"sanitizeFrequencyString"),Bs=n(t=>t.hasAttribute("product")&&{id:t.getAttribute("product"),...t.hasAttribute("product-components")&&{components:JSON.parse(t.getAttribute("product-components"))}},"buildProduct");var Mt=n(t=>{let e=Bs(t);if(!e){let r=t.offer;r&&(e=Bs(r))}return e},"resolveProduct"),Yl=n(t=>{let e=t;for(;e;){if(e.tagName==="OG-OFFER")return e;e=e.nodeType===11?e.host:e.parentNode}},"resolveOffer"),tn=n(t=>class extends t{get offer(){return Yl(this)}connectedCallback(){super.connectedCallback(),this.offersChangeTemplate=this.offersChangeTemplate.bind(this),this.offer&&this.offer.addEventListener("template-changed",this.offersChangeTemplate)}disconnectedCallback(){super.disconnectedCallback(),this.offer&&this.offer.removeEventListener("template-changed",this.offersChangeTemplate)}offersChangeTemplate(){this._enqueueUpdate()}},"withOfferTemplate"),N=n(t=>class extends tn(t){get product(){return Mt(this)}},"withProduct"),$r=n(t=>class extends t{get childOptions(){let e=[],r=null;return this.querySelectorAll("option").forEach(o=>{let i=zl(o.value),s=o.innerText.trim();e.push({value:i,text:s}),!r&&o.selected&&(r=i)}),{options:e,isSelected:r}}},"withChildOptions");var Vr={};jn(Vr,{autoshipByDefault:()=>Wl,eligibilityGroups:()=>on,eligible:()=>zs,hasPrepaidOptions:()=>Xl,hasUpcomingOrder:()=>Ks,hasUpsellGroup:()=>Ws,inStock:()=>rn,optedout:()=>Ql,prepaidEligible:()=>Kl,prepaidSubscribed:()=>Zl,regularEligible:()=>tp,subscribed:()=>Jl,subscriptionEligible:()=>Ys,upcomingOrderContainsProduct:()=>ep,upsellEligible:()=>Js});var rn=n((t,e)=>(t.inStock||{})[(e.product||{}).id],"inStock"),zs=n((t,e)=>(t.autoshipEligible||{})[(e.product||{}).id]||!1,"eligible"),Wl=n((t,e)=>(t.autoshipByDefault||{})[(e.product||{}).id]||!1,"autoshipByDefault"),Ys=n((t,e)=>(t.offerId&&t.offerId!=="0"||!1)&&zs(t,e)&&rn(t,e),"subscriptionEligible"),on=n((t,e)=>{let r=S((e.product||{}).id);return(t.eligibilityGroups||{})[r]||null},"eligibilityGroups"),Ws=n((t,e)=>{let r=on(t,e);return r===null||!!r.find(o=>o==="upsell"||o==="impulse_upsell")},"hasUpsellGroup"),Kl=n((t,e)=>{let r=on(t,e);return(r==null?void 0:r.some(o=>o==="prepaid"))||!1},"prepaidEligible"),Jl=n((t,e)=>hr(e.product)(t),"subscribed"),Ql=n((t,e)=>mr(e.product)(t),"optedout"),Zl=n((t,e)=>vi(e.product)(t),"prepaidSubscribed"),Xl=n((t,e)=>j(e.product.id)(t).length>0,"hasPrepaidOptions"),Ks=n(t=>!!(t.nextUpcomingOrder&&t.nextUpcomingOrder.public_id),"hasUpcomingOrder"),ep=n((t,e)=>(t.nextUpcomingOrder&&t.nextUpcomingOrder.products||[]).includes((e.product||{}).id),"upcomingOrderContainsProduct"),Js=n((t,e)=>{var r;return!((r=e.offer)!=null&&r.isCart)&&t.offerId&&t.offerId!=="0"&&t.auth&&rn(t,e)&&Ks(t)&&Ws(t,e)},"upsellEligible"),tp=n((t,e)=>Ys(t,e)&&!Js(t,e),"regularEligible");var rp=n(t=>t.replace(/(\r\n|\n|\r|\s)+/gm,""),"removeWhitespace"),jr=class extends N(x){static get properties(){return{...super.properties,state:{type:Object,attribute:!1},test:{type:String}}}render(){if(!this.test)return u``;let e=rp(this.test);return e=e.replace(/(![a-zA-Z]+)/g,"($1)"),Qs.default.parse(e,o=>Vr[o]&&Vr[o](this.state,this))?u`
        <slot></slot>
      `:u``}shouldUpdate(e){return e.size&&(this.product&&this.product.id in this.state.autoshipEligible&&this.product.id in this.state.inStock||!this.product.id)}};n(jr,"When");var op=n(t=>({state:t}),"mapStateToProps"),Zs=g(op)(jr);var Xs={type:Object,converter:{toAttribute(t){return t==null?t:JSON.stringify(t)},fromAttribute(t){return t&&t.match(/[{[]/)?JSON.parse(t):{id:t}}}},Pe={type:String,attribute:"default-frequency",converter:{fromAttribute(t){return t&&vo(t)?t:null}}},Gr={type:Boolean,attribute:!0,reflect:!0},dt={type:Object,attribute:!1};var np=n(t=>class extends t{applyTemplate(e){this.template=e;let r=typeof e.markup=="undefined"?this.constructor.initialTemplate:e.markup;r&&this._templateMarkup!==r&&(this._templateMarkup=r,this.innerHTML=r)}refreshTemplate(){if(this._templates&&this._templates.length){let e=this._templates.find(({selector:r})=>{try{return this.matches(r)}catch{return!1}});this.applyTemplate(e||{})}}set templates(e){this._templates=e,this.refreshTemplate()}connectedCallback(){super.connectedCallback&&super.connectedCallback(),this.constructor.initialTemplate&&!this.innerHTML.trim()&&(this.innerHTML=this.constructor.initialTemplate)}},"withTemplate"),z=np(x);var Y=class extends N(z){static get properties(){return{subscribed:Gr,frequencyMatch:{type:Boolean,reflect:!0,attribute:"frequency-match"},productDefaultFrequency:{type:String},defaultFrequency:{type:String},frequencies:{type:Array}}}static get styles(){return b`
      :host {
        cursor: default;
        display: inline-block;
      }

      :host[hidden] {
        display: none;
      }

      .btn {
        position: relative;
        width: var(--og-radio-width, 1.4em);
        height: var(--og-radio-height, 1.4em);
        margin: var(--og-radio-margin, 0);
        padding: 0;
        border: 1px solid var(--og-primary-color, var(--og-border-color, black));
        background: #fff;
        border-radius: 100%;
        vertical-align: middle;
        color: var(--og-primary-color, var(--og-btn-color, black));
      }

      .radio {
        text-indent: -9999px;
        flex-shrink: 0;
      }

      .checkbox {
        border-radius: 3px;
      }

      .radio,
      .checkbox {
        border-color: var(--og-checkbox-border-color, black);
      }

      .checkbox.active::after,
      .radio.active::after {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        box-sizing: border-box;
        background: var(--og-checkbox-border-color, black);
      }

      .radio.active::after {
        content: ' ';
        border-radius: 100%;
        border: 2px solid #fff;
      }

      .checkbox.active::after {
        border: none;
        border-radius: 0;
        background: #fff;
        content: '\\2714';
        line-height: 1;
        text-align: center;
        overflow: visible;
      }
    `}constructor(){super(),this.addEventListener("click",this.handleClick.bind(this))}updated(e){e.has("subscribed")&&(this.frequencyMatch=this.frequency===this.defaultFrequency)}handleClick(){}render(){return this.subscribed&&!this.defaultFrequency?u`
        <slot name="subscribed"></slot>
        <slot name="frequency-mismatch"></slot>
      `:this.subscribed&&this.defaultFrequency===this.frequency?u`
        <slot name="subscribed"></slot>
        <slot name="frequency-match"></slot>
      `:this.subscribed&&this.defaultFrequency!==this.frequency?u`
        <slot name="subscribed"></slot>
        <slot name="frequency-mismatch"></slot>
      `:u`
      <slot name="not-subscribed"></slot>
    `}};n(Y,"OptinStatus");var Z=n((t,e={})=>{var r,o;return{subscribed:ee(e.product)(t),frequency:re(e.product)(t),productDefaultFrequency:Xe((e.product||{}).id)(t),prepaidShipmentsOptedIn:V(e.product)(t),defaultFrequency:oe((r=e.product)==null?void 0:r.id)(t)||G(e,"defaultFrequency"),frequencies:et((o=e.product)==null?void 0:o.id)(t)||G(e,"frequencies"),...tt(t,e),productFrequencies:K(e.product)(t)}},"mapStateToProps"),ea=g(Z)(Y);var ft=class extends Y{static get properties(){return{...super.properties,frequency:{type:String,reflect:!0},defaultFrequency:Pe,optinButtonLabel:{type:String}}}updated(e){if(e.has("subscribed")||e.has("frequencies")){if(A.shopify_selling_plans&&this.store){let r=this.getAttribute("default-frequency");r=Rt(r,this.productFrequencies),this.sellingPlanFreq=r}this.frequencyMatch=this.frequency===this.optinFrequency}}get optinFrequency(){let e;return this.sellingPlanFreq?e=this.sellingPlanFreq:this.hasAttribute("default-frequency")?e=this.getAttribute("default-frequency"):e=this.offer?this.offer.defaultFrequency:this.defaultFrequency,A.shopify_selling_plans&&this.store&&(e=Rt(e,this.productFrequencies)),e}handleClick(e){this.optinProduct(Mt(this),this.optinFrequency,this.offer),e.preventDefault()}render(){return u`
      <slot name="default">
        <button
          aria-labelledby="ogOfferOptInLabel"
          role="radio"
          aria-checked="${!!this.subscribed}"
          class="btn radio ${this.subscribed?"active":""}"
        ></button>
        <label id="ogOfferOptInLabel">
          <slot>
            <slot name="label"><og-text key="offerOptInLabel"></og-text></slot>
          </slot>
        </label>
      </slot>
    `}};n(ft,"OptinButton");var ta=g(Z,{optinProduct:Q})(ft);var Hr=class extends Y{static get properties(){return{...super.properties,label:{type:String}}}handleClick(e){this.optoutProduct(this.product,this.offer),e.preventDefault()}render(){return u`
      <slot name="default">
        <button
          aria-labelledby="ogOfferOptOutLabel"
          role="radio"
          aria-checked="${!this.subscribed}"
          class="btn radio ${this.subscribed?"":"active"}"
        ></button>
        <label id="ogOfferOptOutLabel">
          <slot>
            <og-text key="offerOptOutLabel"></og-text>
          </slot>
        </label>
      </slot>
    `}};n(Hr,"OptoutButton");var ra=g(Z,{optoutProduct:ot})(Hr);var Ue=n((t,e)=>{let{every:r,every_period:o}=Ot(t);return r&&o?u`
        ${r}
        <og-text key="frequencyPeriods" variant="${o}" pluralize="${r}"></og-text>
        ${e&&e===t?u`
              <og-text key="defaultFrequencyCopy"></og-text>
            `:""}
      `:t},"frequencyText"),ht=class extends N(z){static get properties(){return{...super.properties,disabled:{type:Boolean},subscribed:Gr,frequency:{type:String},defaultFrequency:Pe,productDefaultFrequency:{type:String},config:{type:Object},frequencies:{converter:{fromAttribute:_i}}}}static get styles(){return b`
      :host[hidden] {
        display: none;
      }
      :host {
        display: inline-block;
      }
    `}constructor(){super(),this.frequencies=[]}render(){let e=this.frequency||this.defaultFrequency;return u`
      <span>
        ${this.subscribed&&u`
            <slot name="subscribed">${Ue(e)}</slot>
          `||""}
        ${!this.subscribed&&u`
            <slot name="not-subscribed"></slot>
          `||""}
        ${this.subscribed&&this.defaultFrequency&&this.defaultFrequency!==this.frequency&&u`
            <slot name="frequency-mismatch"></slot>
          `||""}
      </span>
    `}};n(ht,"FrequencyStatus");var $t=n((t,e)=>{var r,o;return{subscribed:ee(e.product)(t),frequency:re(e.product)(t),productDefaultFrequency:Xe((e.product||{}).id)(t),frequencies:et((r=e.product)==null?void 0:r.id)(t)||G(e,"frequencies"),defaultFrequency:oe((o=e.product)==null?void 0:o.id)(t)||G(e,"defaultFrequency"),...tt(t,e),productFrequencies:K(e.product)(t)}},"mapStateToProps"),oa=g($t)(ht);var Br=class extends $r(Y){static get properties(){return{...super.properties,frequencies:{type:Array,attribute:!1},frequency:{type:String},defaultFrequency:Pe}}static get styles(){return b`
      :host {
        display: inline-block;
        cursor: pointer;
        background-color: var(--og-select-bg-color, #fff);
        border: var(--og-select-border, 1px solid #aaa);
        border-radius: var(--og-select-border-radius, 0.5em);
        border-width: var(--og-select-border-width, 1px);
        box-shadow: 0 1px 0 1px rgba(0, 0, 0, 0.04);
      }
    `}get currentFrequency(){return this.subscribed?this.frequency||this.productDefaultFrequency||this.defaultFrequency:"optedOut"}onOptinChange(e){e==="optedOut"?this.optoutProduct(this.product,this.offer):this.productChangeFrequency(this.product,e,this.offer)}render(){var o;let{options:e}=this.childOptions,r;if((o=this.frequencies)!=null&&o.length){let{frequenciesText:i}=this.productFrequencies;r=[e.find(s=>s.value==="optedOut"),...this.frequencies.map((s,a)=>({value:s,text:i&&a in i?i[a]:Ue(s,this.defaultFrequency)}))]}else r=e;return u`
      <og-select
        .options="${r}"
        .selected="${this.currentFrequency}"
        .onChange="${({target:{value:i}})=>this.onOptinChange(i)}"
      ></og-select>
    `}};n(Br,"OptinSelect");var na=g((t,e)=>{var r;return{...Z(t,e),...$t(t,e),frequencies:et((r=e.product)==null?void 0:r.id)(t)||G(e,"frequencies")}},{productChangeFrequency:Sr,optoutProduct:ot})(Br);var zr=class extends N(z){static get styles(){return b`
      :host[hidden] {
        display: none;
      }
      :host {
        display: inline-block;
      }
    `}static get properties(){return{...super.properties,upcomingOrderDate:{type:String,attribute:!1},auth:dt,isPreview:{type:Boolean,attribute:!1},target:{type:String},skipModal:{type:Boolean,attribute:"skip-modal"}}}constructor(){super(),this.fetchOrders=()=>0,this.createIu=()=>0,this.concludeUpsell=()=>0,this.addEventListener("click",this.handleClick.bind(this))}updated(e){e.has("auth")&&this.auth&&!this.upcomingOrderDate&&!this.isPreview&&this.fetchOrders()}handleClick(){let e;if(this.skipModal)this.createIu(this.product,this.nextUpcomingOrder.public_id,1,!1,null),this.concludeUpsell(this.product);else if(!this.target&&this.offer)e=this.offer.querySelector("og-upsell-modal"),e||(e=this.offer.shadowRoot.querySelector("og-upsell-modal"));else if(this.target)e=document.querySelector(this.target);else throw Error("You must specify a target attribute or place this element as child of og-offer");e&&e.setAttribute("show",!0)}render(){return u`
      <slot>
        <og-next-upcoming-order></og-next-upcoming-order>
      </slot>
    `}};n(zr,"UpsellButton");var ip=n(t=>({isPreview:t.previewUpsellOffer,nextUpcomingOrder:t.previewUpsellOffer?{public_id:"preview-order-id"}:t.nextUpcomingOrder}),"mapStateToProps"),ia=g(ip,{fetchOrders:Er,createIu:xr,concludeUpsell:_r})(zr);var Yr=class extends N(z){static get properties(){return{...super.properties,defaultFrequency:Pe,auth:dt,subscribed:{type:Boolean,attribute:!1},frequency:{type:String,attribute:!1},nextUpcomingOrder:{type:Object,attribute:!1},show:{type:Boolean,attribute:"show"},offerId:{type:String}}}constructor(){super(),this.createIu=()=>0,this.concludeUpsell=()=>0}render(){return u`
      <og-modal ?show=${this.show} @close=${()=>this.close()} @confirm=${()=>this.confirm()}>
        <div slot="content">
          <slot>
            <slot name="content">
              <og-text key="upsellModalContent"></og-text>
            </slot>
            <slot name="offer">
              <br />

              <og-optout-button>
                <slot name="opt-out-label">
                  <og-text key="upsellModalOptOutLabel" slot="label"></og-text>
                </slot>
              </og-optout-button>
              <br />
              <og-optin-button default-frequency=${this.defaultFrequency}>
                <slot name="opt-in-label">
                  <og-text key="upsellModalOptInLabel" slot="label"></og-text>
                </slot>
              </og-optin-button>
              <br />
              <slot name="every-label">
                <og-text key="offerEveryLabel"></og-text>
              </slot>
              <og-select-frequency default-frequency=${this.defaultFrequency}></og-select-frequency>
            </slot>
          </slot>
        </div>
        <span slot="confirm">
          <slot name="confirm"><og-text key="upsellModalConfirmLabel"></og-text></slot>
        </span>
        <span slot="cancel">
          <slot name="cancel">
            <og-text key="upsellModalCancelLabel"></og-text>
          </slot>
        </span>
      </og-modal>
    `}set defaultFrequency(e){this._defaultFrequency=e}get defaultFrequency(){let e=this.querySelector("og-select-frequency");return e?e.defaultFrequency:this._defaultFrequency}confirm(){this.createIu(this.product,this.nextUpcomingOrder.public_id,1,this.subscribed,this.frequency||this.defaultFrequency),this.close()}close(){this.concludeUpsell(),this.removeAttribute("show")}};n(Yr,"UpsellModal");var sp=n((t,e)=>{var r;return{auth:t.auth,offerId:t.offerId,subscribed:ee(e.product)(t),frequency:re(e.product)(t),defaultFrequency:oe((r=e.product)==null?void 0:r.id)(t)||G(e,"defaultFrequency"),nextUpcomingOrder:t.previewUpsellOffer?{public_id:"preview-order-id"}:t.nextUpcomingOrder,isPreview:t.previewUpsellOffer}},"mapStateToProps"),sa=g(sp,{concludeUpsell:_r,createIu:xr})(Yr);var Wr=class extends Y{static get properties(){return{...super.properties,frequency:{type:String}}}static get styles(){return b`
      :host {
        cursor: default;
        display: inline-block;
      }

      .btn {
        position: relative;
        width: var(--og-radio-width, 1.4em);
        height: var(--og-radio-height, 1.4em);
        margin: var(--og-radio-margin, 0);
        padding: 0;
        border: 1px solid var(--og-checkbox-border-color, black);
        background: #fff;
        vertical-align: middle;
        color: var(--og-primary-color, black);
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 3px;
      }

      .btn.active {
        background: var(--og-checkbox-border-color, black);
      }

      .btn.active:after {
        content: '✓';
        color: #fff;
        transform: scale(1.6);
        margin-left: 2px;
      }
    `}handleClick(e){this.subscribed?this.optoutProduct(this.product,this.offer):this.optinProduct(this.product,this.frequency||this.productDefaultFrequency||this.defaultFrequency,this.offer),e.preventDefault()}render(){return u`
      <slot name="default">
        <button id="action-trigger" class="btn checkbox ${this.subscribed?"active":""}"></button>
        <label for="action-trigger">
          <slot>
            <slot name="label"><og-text key="offerOptInLabel"></og-text></slot>
          </slot>
        </label>
      </slot>
    `}};n(Wr,"OptinToggle");var aa=g(Z,{optoutProduct:ot,optinProduct:Q})(Wr);var ap=n((t,e)=>`${t}${parseInt(e,10)>1?"s":""}`,"pluralize"),Kr=class extends tn(x){static get properties(){return{pluralize:{type:Number},variant:{type:Number},i18n:{type:Object,attribute:!1},locale:{type:Object,attribute:!1},key:{type:String}}}createRenderRoot(){return this}connectedCallback(){super.connectedCallback(),this._textOverride=this.innerText.trim()}getText(){return this._textOverride?this._textOverride:this.getPluralizedText(this.getVariantText(this.key))}getVariantText(e){let r={...this.i18n,...this.offer&&this.offer.locale},o=typeof r[e]!="undefined"?r[e]:"";return typeof this.variant=="undefined"?o:o[this.variant]}getPluralizedText(e){return typeof this.pluralize=="undefined"?e:e&&ap(e,this.pluralize)}render(){return u`
      ${this.getText()}
    `}};n(Kr,"Text");var cp=n(t=>({i18n:t.locale||{}}),"mapStateToProps"),ca=g(cp)(Kr);var Le=class{constructor(e){this.value=e,this.className="DiscountAmount"}toString(){return`${this.value}`}};n(Le,"DiscountAmount");var mt=class extends Le{constructor(e){super(e),this.className="DiscountPercent"}toString(){return`${super.toString()}%`}};n(mt,"DiscountPercent");var Jr=class extends mt{constructor(e){super(e),this.className="ShippingDiscountPercent"}toString(){return this.value===100?"free shipping":super.toString()}};n(Jr,"ShippingDiscountPercent");var nn="Discount Percent",sn="Discount Amount",la="total_price",pa="shipping_total",ua="sub_total",an=n(({field:t,object:e,type:r,value:o})=>{let s=[[new mt(o),{field:la,object:"item",type:nn}],[new Le(o),{field:la,object:"item",type:sn}],[new Jr(o),{field:pa,object:"order",type:nn}],[new Le(o),{field:pa,object:"order",type:sn}],[new mt(o),{field:ua,object:"order",type:nn}],[new Le(o),{field:ua,object:"order",type:sn}]].find(([,a])=>a.field===t&&a.object===e&&a.type===r);return s&&s[0]},"discountBuilder");function lp(t){return!(an(t).className!==this.incentiveClass||this.incentiveValue&&this.incentiveValue.toString()!==t.value.toString())}n(lp,"filterIncentives");var Qr=class extends N(x){static get properties(){return{...super.properties,incentives:{type:Object,attribute:!1},from:{type:String},label:{type:String},initial:{type:Boolean,default:!1},value:{type:Number}}}createRenderRoot(){return this}render(){let e=this.from,r=this.value,o=this.initial?"initial":"ongoing",i=(this.incentives[o]||[]).find(lp.bind({incentiveClass:e,incentiveValue:r}));return u`
      ${this.label} ${i?an(i):this.renderFallback()}
    `}renderFallback(){return u`
      ${an({field:"sub_total",object:"order",type:"Discount Percent",value:this.value})}
    `}};n(Qr,"IncentiveText");var pp=n((t,e)=>{var r;return{incentives:(t.incentives||{})[e&&(e==null?void 0:e.product)&&S((r=e==null?void 0:e.product)==null?void 0:r.id)]||{}}},"mapStateToProps"),da=g(pp)(Qr);var Zr=class extends $r(ht){static get properties(){return{...super.properties,defaultText:{type:String,attribute:"default-text"}}}static get styles(){return b`
      :host {
        display: inline-block;
        cursor: pointer;
        background-color: var(--og-select-bg-color, #fff);
        border: var(--og-select-border, 1px solid #aaa);
        border-radius: var(--og-select-border-radius, 0.5em);
        border-width: var(--og-select-border-width, 1px);
        box-shadow: 0 1px 0 1px rgba(0, 0, 0, 0.04);
        z-index: 1;
      }
    `}set defaultFrequency(e){this._defaultFrequency=e}get defaultFrequency(){var i,s,a,c;let{options:e,isSelected:r}=this.childOptions,o;return this.productDefaultFrequency?o=this.productDefaultFrequency:r?o=r:e.length?o=e[0].value:o=this._defaultFrequency,((s=(i=this.productFrequencies)==null?void 0:i.frequencies)==null?void 0:s.length)&&o&&((c=(a=this.productFrequencies)==null?void 0:a.frequenciesEveryPeriod)==null?void 0:c.length)?Rt(o,this.productFrequencies):o}get currentFrequency(){return this.frequency?this.frequency:this.defaultFrequency}productChangeFrequency(e,r){this.frequency=r}render(){var o;let e,r=this.defaultFrequency;return(o=this.frequencies)!=null&&o.length?e=this.frequencies.map((i,s)=>{let a,{frequenciesEveryPeriod:c,frequenciesText:l}=this.productFrequencies;return c&&s in c?a=Ue(c[s],r):l&&s in l?a=l[s]:a=Ue(i,this.defaultFrequency),{value:i,text:a}}):{options:e}=this.childOptions,e.length||(e=(this.frequencies||[]).map(i=>({value:i,text:Ue(i,r)}))),e=e.map(({text:i,value:s})=>({text:s===r?u`
              ${i} ${this.defaultText||""}
            `:i,value:s})),u`
      <og-select
        ariaLabel="Delivery frequency"
        .options="${e}"
        .selected="${this.currentFrequency}"
        .onChange="${({target:{value:i}})=>{this.productChangeFrequency(this.product,i,this.offer)}}"
      ></og-select>
    `}};n(Zr,"SelectFrequency");var fa=g($t,{productChangeFrequency:Sr})(Zr);var up={day:{day:"2-digit"},"day-numeric":{day:"numeric"},"day-short":{weekday:"short"},"day-long":{weekday:"long"},month:{month:"2-digit"},"month-numeric":{month:"numeric"},"month-short":{month:"short"},"month-long":{month:"long"},year:{year:"2-digit"},"year-numeric":{year:"numeric"}};var ha=n((t,e)=>t instanceof Date?(e||"").toString().replace(/\{\{([-\w]+)\}\}/g,r=>{let o=r.replace(/[{}]/g,""),i=up[o];if(typeof i=="undefined")return o;let a=new Intl.DateTimeFormat("en-us",i).formatToParts(t),[{value:c}]=a;return c}):t,"formatDate");var Xr=class extends x{static get properties(){return{value:{type:String,reflect:!0},format:{type:String}}}createRenderRoot(){return this}render(){return u`
      ${ha(this.value,this.format||"{{month-long}} {{day}}, {{year-numeric}}")}
    `}};n(Xr,"FormattedDate");var dp=n(t=>({value:t.previewUpsellOffer?new Date:t.nextUpcomingOrder.place}),"mapStateToProps"),ma=g(dp)(Xr);var ba=ae(xt());var ga=n((t,e,r)=>n(async function(i){await i({type:fe,payload:{isPreview:t,productId:e}}),await i({type:Oe}),await i(be({in_stock:{[e]:!0},eligibility_groups:{[e]:["subscription","upsell"]},result:"success",autoship:{[e]:!0},autoship_by_default:{[e]:!1},modifiers:{},module_view:{regular:"096135e6650111e9a444bc764e106cf4"},incentives_display:{"47c01e9aacbe40389b5c7325d79091aa":{field:"sub_total",object:"order",type:"Discount Percent",value:5},e6534b9d877f41e586c37b7d8abc3a58:{field:"total_price",object:"item",type:"Discount Percent",value:10},f35e842710b24929922db4a529eecd40:{field:"total_price",object:"item",type:"Discount Percent",value:10},"5be321d7c17f4e18a757212b9a20bfcc":{field:"total_price",object:"item",type:"Discount Percent",value:1}},incentives:{[e]:{initial:["5be321d7c17f4e18a757212b9a20bfcc"],ongoing:["e6534b9d877f41e586c37b7d8abc3a58","47c01e9aacbe40389b5c7325d79091aa","f35e842710b24929922db4a529eecd40"]}}},r,e))},"setPreviewStandardOfferThunk"),"setPreviewStandardOffer"),fp=n((t,e)=>(Object.entries(e).forEach(([r,o])=>{if(Object.prototype.hasOwnProperty.call(t,r)){let i=t[r].concat(o),s=[...new Set(i.map(a=>JSON.stringify(a)))];t[r]=s.map(a=>JSON.parse(a))}else t[r]=o}),t),"mergeProductPlansToState"),hp=n((t,e,r)=>n(async function(i,s){await i({type:_t,payload:{isPreview:t,productId:e}});let{merchantId:a}=s();t?(await i(be({in_stock:{[e]:!0},module_view:{regular:"096135e6650111e9a444bc764e106cf4"},default_frequencies:{[e]:{every:1,every_period:3}},eligibility_groups:{[e]:["subscription","upsell"]},result:"success",autoship:{[e]:!0},autoship_by_default:{[e]:!1},modifiers:{}},r,e)),await i(Io({count:1,next:null,previous:null,results:[{merchant:"0e5de2bedc5e11e3a2e4bc764e106cf4",customer:"TestCust",payment:"e98e789aba0111e9b90fbc764e107990",shipping_address:"b3a5816ae59611e78937bc764e1043b0",public_id:"23322d4a83eb11ea9a1ebc764e101db1",sub_total:"206.98",tax_total:"0.00",shipping_total:"10.00",discount_total:"0.00",total:"216.98",created:"2020-04-21 11:14:11",place:"2020-06-24 00:00:00",cancelled:null,tries:0,generic_error_count:0,status:1,type:1,order_merchant_id:null,rejected_message:null,extra_data:null,locked:!1,oos_free_shipping:!1}]})),await i(At(a,"sig_field","ts","sig"))):await i(ge())},"setPreviewUpsellOfferThunk"),"setPreviewUpsellOffer"),mp=n((t,e,r)=>n(async function(i,s){let a=s().productPlans;await i({type:bo,payload:{isPreview:t,productId:e}}),await i({type:Oe}),await i(be({in_stock:{[e]:!0},eligibility_groups:{[e]:["subscription","upsell","prepaid"]},result:"success",autoship:{[e]:!0},autoship_by_default:{[e]:!1},modifiers:{},module_view:{regular:"096135e6650111e9a444bc764e106cf4"},incentives_display:{"47c01e9aacbe40389b5c7325d79091aa":{field:"sub_total",object:"order",type:"Discount Percent",value:5},e6534b9d877f41e586c37b7d8abc3a58:{field:"total_price",object:"item",type:"Discount Percent",value:10},f35e842710b24929922db4a529eecd40:{field:"total_price",object:"item",type:"Discount Percent",value:10},"5be321d7c17f4e18a757212b9a20bfcc":{field:"total_price",object:"item",type:"Discount Percent",value:1}},incentives:{[e]:{initial:["5be321d7c17f4e18a757212b9a20bfcc"],ongoing:["e6534b9d877f41e586c37b7d8abc3a58","47c01e9aacbe40389b5c7325d79091aa","f35e842710b24929922db4a529eecd40"]}}},r,e)),await i({type:We,payload:fp(a,Nr({[e]:[{frequency:"1_3",regularPrice:"$15.00",subscriptionPrice:"$12.00",discountRate:"25%",prepaidShipments:3,regularPrepaidPrice:"$36.00",prepaidSavingsPerShipment:"$3.00",prepaidSavingsTotal:"$9.00",prepaidExtraSavingsPercentage:"10%"},{frequency:"1_3",regularPrice:"$15.00",subscriptionPrice:"$12.00",discountRate:"20%",prepaidShipments:6,regularPrepaidPrice:"$72.00",prepaidSavingsPerShipment:"$3.00",prepaidSavingsTotal:"$18.00",prepaidExtraSavingsPercentage:"10%"},{frequency:"1_3",regularPrice:"$15.00",subscriptionPrice:"$12.00",discountRate:"20%",prepaidShipments:12,regularPrepaidPrice:"$144.00",prepaidSavingsPerShipment:"$3.00",prepaidSavingsTotal:"$36.00",prepaidExtraSavingsPercentage:"10%"}]}))}),await i({type:Ye,payload:{prepaidSellingPlans:{[e]:[{numberShipments:3,sellingPlan:"1_3"},{numberShipments:6,sellingPlan:"1_3"},{numberShipments:12,sellingPlan:"1_3"}]}}})},"setPreviewPrepaidThunk"),"setPreviewPrepaid"),ya=n((t,e,r)=>async function(o,i){switch(await o({type:he}),await o({type:fe,payload:{isPreview:!1,productId:r.product.id}}),await o({type:_t,payload:{isPreview:!1,productId:r.product.id}}),t){case"regular":o(ga(!0,r.product.id,r));break;case"upsell":o(hp(!0,r.product.id,r));break;case"subscribed":o(ga(!0,r.product.id,r)),o(Q(r.product,"2_2"));break;case"prepaid":o(mp(!0,r.product.id,r)),o(Q(r.product,"1_3"));break;default:}},"setPreview");var gp=n((...t)=>JSON.stringify(t),"memoizeKey"),Sa=n(t=>{let e=!1;return(...r)=>{e||(console.warn(t(...r)),e=!0)}},"logOnce"),yp=Sa((t,e)=>`Hiding Ordergroove offer since the store currency ${t} does not match your configured currency ${e} and you are not set up for multicurrency. Contact your Ordergroove representative for next steps.`),lg=Sa(()=>"Hiding Ordergroove offer since cart offers does not currently support product-specific frequency lists."),bp=(0,ba.default)((t,e)=>Object.assign({components:e},t),gp),eo=class extends z{static get properties(){return{...super.properties,config:{type:Object,attribute:!1},product:Xs,productComponents:{type:Array,attribute:"product-components"},offerId:{type:String,attribute:!1},auth:dt,preview:{type:String,attribute:"preview",reflect:"true"},location:{type:String},autoshipByDefault:{type:Boolean,attribute:"autoship-by-default"},productDefaultFrequency:{type:String,attribute:!1},locale:{type:Object,attribute:!0},firstOrderPlaceDate:{type:String,attribute:"first-order-place-date"},productToSubscribe:{type:String,attribute:"product-to-subscribe"},subscribed:{type:Boolean,reflect:!0},frequency:{type:String,reflect:!0},productFrequency:{type:String},isCart:{type:Boolean,attribute:"cart"},optedin:{type:Object},variationId:{type:String}}}firstUpdated(){try{let e=Array.from(this.getAttributeNames()).find(r=>r.startsWith("preview-"));e==="preview-standard-offer"?this.preview="regular":e==="preview-upsell-offer"?this.preview="upsell":e==="preview-subscribed-offer"?this.preview="subscribed":e==="preview-prepaid-offer"&&(this.preview="prepaid")}catch(e){console.warn("Unable to set preview property",e)}}static get styles(){return b`
      :host[hidden] {
        display: none;
      }

      :host {
        display: block;
      }

      :host {
        color: var(--og-global-color, #000);
        font-family: var(--og-global-family, inherit);
        font-size: var(--og-global-size, inherit);
        padding: var(--og-wrapper-padding, 10px 0);
        min-width: var(--og-wrapper-min-width, 0);
      }

      p {
        margin: 0 0 0.3em;
      }

      :host og-upsell-button button {
        font-family: var(--og-upsell-family, inherit);
        font-size: var(--og-upsell-size, inherit);
        background-color: var(--og-upsell-background, inherit);
        color: var(--og-upsell-color, inherit);
      }

      .og-modal__btn {
        font-size: var(--og-modal-button-size, 0.875rem);
        font-family: var(--og-modal-button-family, inherit);
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        background-color: var(--og-modal-button-background, #e6e6e6);
        color: var(--og-modal-button-color, rgba(0, 0, 0, 0.8));
        border-radius: 0.25rem;
        border-style: none;
        border-width: 0;
        cursor: pointer;
        -webkit-appearance: button;
        text-transform: none;
        overflow: visible;
        line-height: 1.15;
        margin: 0;
        will-change: transform;
        -moz-osx-font-smoothing: grayscale;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        transition: -webkit-transform 0.25s ease-out;
        transition: transform 0.25s ease-out;
        transition:
          transform 0.25s ease-out,
          -webkit-transform 0.25s ease-out;
      }

      .og-modal__btn:focus,
      .og-modal__btn:hover {
        -webkit-transform: scale(1.05);
        transform: scale(1.05);
      }

      .og-modal__btn-primary {
        background-color: var(--og-confirm-button-background, #00449e);
        color: var(--og-confirm-button-color, #fff);
      }
    `}static get initialTemplate(){return`
    <og-when test="regularEligible">
      <div>

        <og-optout-button>
          <og-text key="offerOptOutLabel"></og-text>
        </og-optout-button>
      </div>
      <div>
        <og-optin-button>
          <og-price discount>
            <span slot="prepend">Subscribe and get</span>
            <span slot="append">off</span>
            <og-text key="offerOptInLabel" slot="fallback"></og-text> 
          </og-price>
          <og-price regular></og-price>
          <og-price subscription></og-price>
    
        </og-optin-button>
        <og-tooltip placement="bottom">
          <div slot="trigger">
            <og-text key="offerTooltipTrigger"></og-text>
          </div>
          <div slot="content">
            <og-text key="offerTooltipContent"></og-text>
          </div>
        </og-tooltip>
      </div>
      <div style="margin-left: 2.2em">
        <og-text key="offerEveryLabel"></og-text>
        <og-select-frequency>
          <option value="3_1" selected>3 Days</option>
          <option value="1_2">1 Week</option>
          <option value="1_3">1 Month</option>
        </og-select-frequency>
      </div>
    </og-when>

    <og-when test="upsellEligible">
      <og-when test="!upcomingOrderContainsProduct">
      <div class="og-iu-offer">
        <og-text key="upsellButtonLabel"></og-text>
        <og-upsell-button>
          <button type="button">
            <og-text key="upsellButtonContent"></og-text>
            <og-next-upcoming-order></og-next-upcoming-order>
          </button>
        </og-upsell-button>
        <og-upsell-modal>
          <og-text key="upsellModalContent"></og-text>
          <br />

          <og-optout-button>
            <og-text key="upsellModalOptOutLabel"></og-text>
          </og-optout-button>

          <br />

          <og-optin-button>
            <og-text key="upsellModalOptInLabel"></og-text>
          </og-optin-button>
          <br />

          <og-text key="offerEveryLabel"></og-text>
          <og-select-frequency>
            <option value="3_1" selected>3 Days</option>
            <option value="1_2">1 Week</option>
            <option value="1_3">1 Month</option>
          </og-select-frequency>

          <button slot="confirm" class="og-modal__btn og-modal__btn-primary">
            <og-text key="upsellModalConfirmLabel"></og-text>
          </button>
          <button slot="cancel" class="og-modal__btn"><og-text key="upsellModalCancelLabel"></og-text></button>
        </og-upsell-modal>
      </div>
      </og-when>
      <og-when test="upcomingOrderContainsProduct">
        The product is in your next upcomming order
      </og-when>
    </og-when>
    
    `}constructor(){super(),this.module="pdp",this.product={},this.productComponents=[],this.fetchOffer=()=>0,this.fetchOrders=()=>0,this.productHasChangedComponents=()=>0,this.setFirstOrderPlaceDate=()=>0,this.setProductToSubscribe=()=>0,this.productChangeFrequency=()=>0}applyTemplate(e){super.applyTemplate(e);let{id:r,locale:o}=e;this.variationId=r,this.locale=o;let i=new CustomEvent("template-changed");this.dispatchEvent(i)}updated(e){if(e.has("preview")&&this.setPreview(this.preview,e.get("preview"),this),this.frequency=this.defaultFrequency,e.has("product")&&!this.isPreview&&gr(()=>this.fetchOffer(this.product.id,Ke,this)),e.has("firstOrderPlaceDate")&&this.product.id&&!this.isPreview&&this.setFirstOrderPlaceDate(this.product.id,this.firstOrderPlaceDate),e.has("productToSubscribe")&&this.product.id&&!this.isPreview&&this.setProductToSubscribe(this.product.id,this.productToSubscribe),e.has("auth")&&this.auth&&!this.isPreview&&this.fetchOrders(),e.has("productComponents")){let r=bp(this.product,this.productComponents),o=Object.assign({},this.product,{components:e.get("productComponents")});I(r,o)||this.productHasChangedComponents(r,o)}(e.has("offerId")||e.has("autoshipByDefault")||e.has("location")||e.has("product"))&&this.offerId&&this.autoshipByDefault&&(this.location==="cart"||this.isCart)&&this.product.id&&this.optinProduct&&!(this.optedin||[]).find(r=>I(r,this.product))&&this.optinProduct({...this.product,...this.productComponents.length&&{components:this.productComponents}},this.defaultFrequency,this)}get isPreview(){return this.preview||window.og.previewMode}get shouldEnableOffer(){return this.config&&this.config.storeCurrency&&this.config.merchantSettings&&!(this.config.merchantSettings.multicurrency_enabled||this.config.storeCurrency===this.config.merchantSettings.currency_code)?(yp(this.config.storeCurrency,this.config.merchantSettings.currency_code),!1):!0}render(){return this.shouldEnableOffer?u`
          <slot></slot>
        `:null}get defaultFrequency(){let e=this.productFrequency||this.productDefaultFrequency;if(e)return e;let r=this.querySelector("og-select-frequency");if(r&&r.currentFrequency)return r.currentFrequency;let o=this.getValueFromAttribute("defaultFrequency");return o||(this.template&&this.template.config&&typeof this.template.config.defaultFrequency!="undefined"?this.template.config.defaultFrequency:this.configDefaultFrequency)}getValueFromAttribute(e){let r=wo(e);if(this.hasAttribute(r)){let o=this.getAttribute(r);return o.toString().toLowerCase()==="true"?!0:o.toString().toLowerCase()==="false"?!1:o}}};n(eo,"Offer");var Sp=n((t,e)=>{var r;return{config:t.config,auth:t.auth,offerId:((t.productOffer||{})[(e.product||{}).id]||[])[0],configDefaultFrequency:oe((r=e.product)==null?void 0:r.id)(t),productFrequency:re(e.product)(t),productDefaultFrequency:Xe((e.product||{}).id)(t),autoshipByDefault:t.config&&t.config.autoshipByDefault||G(e,"autoshipByDefault",To(t)[(e.product||{}).id]),...mr(e.product)(t)&&{autoshipByDefault:!1},optedin:Ct(t),subscribed:ee(e.product)(t),...tt(t)}},"mapStateToProps"),_a=g(Sp,{fetchOffer:Di,fetchOrders:Er,productHasChangedComponents:Ai,optinProduct:Q,setFirstOrderPlaceDate:ji,setProductToSubscribe:Gi,setPreview:ya})(eo);var Vt=class extends x{constructor(){super(),this.showCancelButton=!0,this.showConfirmButton=!0}static get properties(){return{title:{type:String,attribute:!1},content:{type:String,attribute:!1},confirmText:{type:String,attribute:!1},cancelText:{type:String,attribute:!1},showCancelButton:{type:Boolean},showConfirmButton:{type:Boolean},show:{type:Boolean,attribute:"show"}}}static get styles(){return b`
      :host[hidden] {
        display: none;
      }

      :host {
        display: block;
      }

      .og-modal {
        display: none;
      }

      .og-modal.is-open {
        display: block;
      }

      .og-modal__overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
      }

      .og-modal__container {
        background-color: var(--og-modal-background-color, #fff);
        padding: var(--og-modal-padding, 30px);
        max-width: 500px;
        max-height: 100vh;
        border-radius: var(--og-modal-border-radius, 4px);
        box-sizing: border-box;
      }

      .og-modal__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .og-modal__title {
        margin-top: 0;
        margin-bottom: 0;
        font-weight: 600;
        font-size: 1.25rem;
        line-height: 1.25;
        color: #00449e;
        box-sizing: border-box;
      }

      .og-modal__close {
        background: transparent;
        border: 0;
      }

      .og-modal__close:before {
        content: '✕';
      }

      .og-modal__content {
        margin-top: 2rem;
        margin-bottom: 2rem;
        line-height: 1.5;
      }

      .og-modal__btn {
        font-size: var(--og-modal-button-size, 0.875rem);
        font-family: var(--og-modal-button-family, inherit);
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        background-color: var(--og-modal-button-background, #e6e6e6);
        color: var(--og-modal-button-color, rgba(0, 0, 0, 0.8));
        border-radius: 0.25rem;
        border-style: none;
        border-width: 0;
        cursor: pointer;
        -webkit-appearance: button;
        text-transform: none;
        overflow: visible;
        line-height: 1.15;
        margin: 0;
        will-change: transform;
        -moz-osx-font-smoothing: grayscale;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        transition: -webkit-transform 0.25s ease-out;
        transition: transform 0.25s ease-out;
        transition:
          transform 0.25s ease-out,
          -webkit-transform 0.25s ease-out;
      }

      .og-modal__btn:focus,
      .og-modal__btn:hover {
        -webkit-transform: scale(1.05);
        transform: scale(1.05);
      }

      .og-modal__btn-primary {
        background-color: var(--og-confirm-button-background, #00449e);
        color: var(--og-confirm-button-color, #fff);
      }
      .btn {
        cursor: pointer;
      }
    `}close(){this.removeAttribute("show"),this.dispatchEvent(new CustomEvent("close"))}confirm(){this.removeAttribute("show"),this.dispatchEvent(new CustomEvent("confirm"))}get confirmButton(){return this.showConfirmButton?u`
          <span @click="${()=>this.confirm()}">
            <slot name="confirm" class="btn">
              <button class="og-modal__btn og-modal__btn-primary og-modal__confirm" @click="${()=>this.confirm()}">
                ${this.confirmText}
              </button>
            </slot>
          </span>
        `:u``}get cancelButton(){return this.showCancelButton?u`
          <span @click="${()=>this.close()}" class="btn">
            <slot name="cancel">
              <button class="og-modal__btn og-modal__cancel" @click="${()=>this.close()}">${this.cancelText}</button>
            </slot>
          </span>
        `:u``}render(){return this.show?u`
      <div class="og-modal is-open" aria-hidden="true">
        <div class="og-modal__overlay" tabindex="-1">
          <div class="og-modal__container" role="dialog" aria-modal="true">
            <header class="og-modal__header">
              <h2 class="og-modal__title">
                <slot name="title">${this.title}</slot>
              </h2>
              <button class="og-modal__close" aria-label="Close" @click="${()=>this.close()}"></button>
            </header>
            <main class="og-modal__content">
              <slot name="content">${this.content}</slot>
            </main>
            <footer class="og-modal__footer">${this.confirmButton} ${this.cancelButton}</footer>
          </div>
        </div>
      </div>
    `:u``}};n(Vt,"Modal");var jt=class extends x{static get styles(){return b`
      :host {
        display: inline-block;
        color: inherit;
        position: relative;
        height: 100%;
        cursor: inherit;
        font-family: inherit;
        font-weight: inherit;
      }
      select {
        font-weight: inherit;
        display: block;
        height: 100%;
        cursor: inherit;
        color: inherit;
        font-family: inherit;
        font-size: 1em;
        line-height: 1.3;
        padding: var(--og-select-padding, 0.4em 1.8em 0.3em 0.5em);
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        margin: 0;
        border: none;
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
        background-color: transparent;
      }
      select::-ms-expand {
        display: none;
      }
      select:focus {
        outline: none;
      }
      select option {
        font-weight: inherit;
      }
      span {
        position: absolute;
        // background: white;
        color: inherit;
        fill: white;
        pointer-events: none;
        right: 0.3em;
        top: 50%;
        z-index: 1;
        font-size: 1em;
        line-height: 0.2em;
        transform: scaleY(0.5);
      }
    `}static get properties(){return{options:{type:Array},selected:{type:String},ariaLabel:{type:String}}}render(){return u`
      <select @change="${n(r=>this.onChange(r),"handleOnChange")}" aria-label="${this.ariaLabel}">
        ${this.options.map(r=>u`
            <option
              value="${r.value}"
              ?selected=${r.value===this.selected}
              .selected=${r.value===this.selected}
            >
              ${r.text}
            </option>
          `)}
      </select>
      <span>&#9660;</span>
    `}};n(jt,"Select");var cn=new WeakMap,ln=Go(t=>e=>{let r=cn.get(e);if(t===void 0&&e instanceof _e){if(r!==void 0||!cn.has(e)){let o=e.committer.name;e.committer.element.removeAttribute(o)}}else t!==r&&e.setValue(t);cn.set(e,t)});var ve={AUTOMATIC:"automatic",MANUAL:"manual"},Gt=class extends x{constructor(){super(),this.triggerLabel="Show tooltip",this.open=!1,this.activationType=ve.AUTOMATIC}static get properties(){return{placement:{type:String,default:"bottom"},triggerLabel:{type:String,attribute:"trigger-label"},activationType:{type:String,attribute:"activation-type"},open:{type:Boolean,attribute:!1}}}static get styles(){return b`
      :host[hidden] {
        display: none;
      }

      :host {
        display: inline-block;
        position: relative;
        z-index: 9;
      }

      /* reset default button styles */
      button.trigger {
        all: unset;
      }

      /* do not reset the button's default focus outline */
      button.trigger:focus {
        outline: revert;
      }

      .trigger {
        display: block;
        cursor: pointer;
      }

      /* for manual activation, hide the content completely from screen readers when the tooltip is closed */
      /* otherwise, interactive elements may receive focus even when they are not visible */
      [data-manual] .content {
        visibility: hidden;
      }

      .content {
        box-sizing: border-box;
        font-family: var(--og-tooltip-family, inherit);
        font-size: var(--og-tooltip-size, inherit);
        color: var(--og-tooltip-color, inherit);
        background-color: var(--og-tooltip-background, #ececec);
        box-shadow: var(--og-tooltip-box-shadow, 2px 2px 6px rgba(0, 0, 0, 0.28));
        display: block;
        opacity: 0;
        padding: var(--og-tooltip-padding, 0.5em);
        text-align: var(--og-tooltip-text-align, left);
        pointer-events: none;
        position: absolute;
        transform: translateY(10px);
        transition: transform 0.25s ease-out;
        z-index: 99999;
        border-radius: var(--og-tooltip-border-radius, 0);
      }

      .content:after {
        content: ' ';
        height: 0;
        position: absolute;
        width: 0;
      }

      .top {
        bottom: 100%;
        margin-bottom: 10px;
      }

      .bottom {
        top: 100%;
        margin-top: 10px;
      }

      .left {
        right: 100%;
        margin-right: 10px;
      }

      .right {
        left: 100%;
        margin-left: 10px;
      }

      .top-left {
        bottom: 100%;
        margin-bottom: 10px;
        right: 100%;
        margin-right: -16px;
      }

      .top-right {
        bottom: 100%;
        margin-bottom: 10px;
        left: 100%;
        margin-left: -16px;
      }

      .bottom-left {
        top: 100%;
        margin-top: 10px;
        right: 100%;
        margin-right: -16px;
      }

      .bottom-right {
        top: 100%;
        margin-top: 10px;
        left: 100%;
        margin-left: -16px;
      }

      .bottom-left:after,
      .bottom-right:after,
      .top-left:after,
      .top-right:after,
      .top:after,
      .bottom:after {
        margin-left: -10px;
        left: 50%;
        border-left: solid transparent 10px;
        border-right: solid transparent 10px;
      }

      .top-left:after,
      .top-right:after,
      .top:after {
        bottom: -10px;
        border-top: solid var(--og-tooltip-background, #ececec) 10px;
      }
      .bottom-left:after,
      .top-left:after {
        left: auto;
        right: 0;
      }

      .bottom-right:after,
      .top-right:after {
        left: 0;
        right: auto;
        margin-left: 0;
      }

      .bottom-left:after,
      .bottom-right:after,
      .bottom:after {
        top: -10px;
        border-bottom: solid var(--og-tooltip-background, #ececec) 10px;
      }

      .left:after,
      .right:after {
        margin-top: -10px;
        top: 50%;
        border-top: solid transparent 10px;
        border-bottom: solid transparent 10px;
      }
      .right:after {
        left: -10px;
        border-right: solid var(--og-tooltip-background, #ececec) 10px;
      }
      .left:after {
        right: -10px;
        border-left: solid var(--og-tooltip-background, #ececec) 10px;
      }

      .tooltip[data-open] .content {
        visibility: visible;
        opacity: 1;
        width: 200px;
        pointer-events: auto;
        transform: translateY(0px);
      }
    `}connectedCallback(){super.connectedCallback(),this.abortController=new AbortController;let e=this.abortController.signal;this.addEventListener("mouseenter",this.handleMouseEnter.bind(this),{signal:e}),this.addEventListener("mouseleave",this.handleMouseLeave.bind(this),{signal:e}),this.addEventListener("focusin",this.handleFocusIn.bind(this),{signal:e}),this.addEventListener("focusout",this.handleFocusOut.bind(this),{signal:e}),this.addEventListener("keydown",this.handleKeyDown.bind(this),{signal:e}),document.addEventListener("click",this.handleDocumentClick.bind(this),{signal:e})}async recalculatePosition(){if(await this.updateComplete,!this.open)return;let r=this.shadowRoot.querySelector(".trigger").getBoundingClientRect(),o=this.shadowRoot.querySelector(".content"),i=o.getBoundingClientRect();!this.placement||this.placement==="top"||this.placement==="bottom"?o.style.left=`${(-1*i.width+r.width)/2}px`:(this.placement==="left"||this.placement==="right")&&(o.style.top=`${(-1*i.height+r.height)/2}px`)}handleMouseEnter(){this.open=!0,this.recalculatePosition()}handleMouseLeave(){this.open=!1}handleFocusIn(){this.activationType===ve.AUTOMATIC&&(this.open=!0,this.recalculatePosition())}handleFocusOut(e){this.activationType===ve.AUTOMATIC&&(this.contains(e.relatedTarget)||(this.open=!1))}handleKeyDown(e){this.activationType===ve.MANUAL&&e.key==="Escape"&&this.open&&(this.open=!1,e.stopPropagation())}handleClick(){this.activationType===ve.MANUAL&&(this.open=!this.open,this.recalculatePosition())}handleDocumentClick(e){this.activationType!==ve.MANUAL||!this.open||this.contains(e.target)||(this.open=!1)}disconnectedCallback(){super.disconnectedCallback(),this.abortController.abort()}render(){let e=this.triggerLabel?this.triggerLabel:void 0;return u`
      <span class="tooltip" ?data-open="${this.open}" ?data-manual="${this.activationType===ve.MANUAL}">
        ${this.activationType===ve.MANUAL?u`
              <button
                class="trigger"
                aria-label="${ln(e)}"
                aria-expanded="${this.open}"
                aria-controls="tooltip-content"
                @click="${this.handleClick}"
              >
                <slot name="trigger">${this.trigger}</slot>
              </button>
            `:u`
              <span class="trigger" tabindex="0" aria-label="${ln(e)}">
                <slot name="trigger">${this.trigger}</slot>
              </span>
            `}
        <div class="content ${this.placement||"bottom"}" role="tooltip" id="tooltip-content">
          <slot name="content">${this.content}</slot>
        </div>
      </span>
    `}};n(Gt,"Tooltip");var W=class extends N(x){static get properties(){return{options:{type:Array},shipmentsOptedIn:{type:Number},prepaidShipmentsSelected:{type:Number},defaultPrepaidShipments:{type:Number,attribute:"default-prepaid-shipments"}}}get prepaidOptedIn(){return this.shipmentsOptedIn>1}get selectedNumberOfShipments(){return this.prepaidShipmentsSelected||this.shipmentsOptedIn||this.getDefaultPrepaidShipments()}getDefaultPrepaidShipments(){return this.options.includes(this.defaultPrepaidShipments)?this.defaultPrepaidShipments:this.options[1]||this.options[0]}handleSelect({target:{value:e}}){let r=+e;this.productChangePrepaidShipments(this.product,r,this.offer)}render(){return u``}};n(W,"PrepaidStatus");var _p=n((t,e)=>({options:j(e.product.id)(t),shipmentsOptedIn:V(e.product)(t),prepaidShipmentsSelected:te(e.product)(t)}),"mapStateToProps"),Og=g(_p,{productChangePrepaidShipments:ye})(W);var to=class extends W{constructor(){super(),this.options=[],this.text="shipments"}static get properties(){return{...super.properties,text:{type:String}}}static get styles(){return b`
      og-select {
        display: inline-block;
        cursor: pointer;
        background-color: var(--og-select-bg-color, #fff);
        border: var(--og-select-border, 1px solid #aaa);
        border-width: var(--og-select-border-width, 1px);
        box-shadow: 0 1px 0 1px rgba(0, 0, 0, 0.04);
        z-index: 1;
      }

      input {
        width: 1.2em;
        height: 1.2em;
        accent-color: var(--og-prepaid-checkbox-color, black);
        border-radius: 4px;
      }
    `}handleChange(e){e.target.checked?this.productChangePrepaidShipments(this.product,this.selectedNumberOfShipments,this.offer):this.productChangePrepaidShipments(this.product,null,this.offer)}render(){if(this.options.length===0)return u``;let e=this.options.map(r=>({value:r,text:`${r} ${this.text}`}));return u`
      <div>
        <input id="cbx" type="checkbox" .checked=${this.prepaidOptedIn} @change=${this.handleChange} />
        <label for="cbx">
          <slot name="label">Prepay for</slot>
          ${this.options.length>1?u`
                <og-select
                  .options=${e}
                  .selected=${this.selectedNumberOfShipments}
                  .onChange="${r=>this.handleSelect(r)}"
                ></og-select>
              `:u`
                <span>${e[0].text}</span>
              `}
          <slot name="append"></slot>
        </label>
      </div>
    `}};n(to,"PrepaidToggle");var Ep=n((t,e)=>({options:j(e.product.id)(t),shipmentsOptedIn:V(e.product)(t),prepaidShipmentsSelected:te(e.product)(t)}),"mapStateToProps"),Ea=g(Ep,{productChangePrepaidShipments:ye})(to);var ro=class extends W{static get properties(){return{...super.properties,productPlans:{type:Object},prepaidShipmentsSelected:{type:Number},totalPrice:{type:Boolean,reflect:!0,attribute:"total-price"},perDeliveryPrice:{type:Boolean,reflect:!0,attribute:"per-delivery-price"},totalSavings:{type:Boolean,reflect:!0,attribute:"total-savings"},perDeliverySavings:{type:Boolean,reflect:!0,attribute:"per-delivery-savings"},percentageSavings:{type:Boolean,reflect:!0,attribute:"percentage-savings"},extraPercentageSavings:{type:Boolean,reflect:!0,attribute:"extra-percentage-savings"},numberOfShipments:{type:Boolean,reflect:!0,attribute:"number-of-shipments"}}}static get styles(){return b`
      :host {
        display: inline-block;
        text-indent: initial;
      }
    `}get value(){let e=S(this.product),r=this.productPlans[e]||[],o=this.selectedNumberOfShipments,i=r.find(h=>h.prepaidShipments>1&&h.prepaidShipments===o);if(!i&&(i=r.find(h=>h.prepaidShipments>1),!i))return"";let{discountRate:s,subscriptionPrice:a,prepaidShipments:c,regularPrepaidPrice:l,prepaidSavingsPerShipment:p,prepaidSavingsTotal:d,prepaidExtraSavingsPercentage:f}=i;return this.totalPrice?l:this.perDeliveryPrice?a:this.totalSavings?d:this.perDeliverySavings?p:this.percentageSavings?s:this.extraPercentageSavings?f:this.numberOfShipments?c:""}render(){let e=this.value;return e?u`
        <slot name="prepend"></slot>
        ${e}
        <slot name="append"></slot>
      `:u`
      <slot name="fallback"></slot>
    `}};n(ro,"PrepaidData");var xp=n((t,e)=>({options:j(e.product.id)(t),shipmentsOptedIn:V(e.product)(t),prepaidShipmentsSelected:te(e.product)(t),productPlans:t.productPlans}),"mapStateToProps"),xa=g(xp)(ro);var oo=class extends W{constructor(){super(),this.addEventListener("click",this.handleClick.bind(this))}static get styles(){return b`
      :host {
        cursor: pointer;
        display: inline-block;
      }

      :host[hidden] {
        display: none;
      }

      .btn {
        position: relative;
        width: var(--og-radio-width, 1.4em);
        height: var(--og-radio-height, 1.4em);
        margin: var(--og-radio-margin, 0);
        padding: 0;
        border: 1px solid var(--og-primary-color, var(--og-border-color, black));
        background: #fff;
        border-radius: 100%;
        vertical-align: middle;
        color: var(--og-primary-color, var(--og-btn-color, black));
      }

      .radio {
        text-indent: -9999px;
        flex-shrink: 0;
      }

      .radio {
        border-color: var(--og-checkbox-border-color, black);
      }

      .radio.active::after {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        box-sizing: border-box;
        background: var(--og-checkbox-border-color, black);
      }

      .radio.active::after {
        content: ' ';
        border-radius: 100%;
        border: 2px solid #fff;
      }
    `}handleClick(e){this.prepaidOptedIn||this.productChangePrepaidShipments(this.product,this.selectedNumberOfShipments,this.offer),e.preventDefault()}render(){return u`
      <slot name="default">
        <button id="action-trigger" class="btn radio ${this.prepaidOptedIn?"active":""}"></button>
        <label for="action-trigger">
          <slot name="label"><og-text key="prepaidOptInLabel"></og-text></slot>
        </label>
      </slot>
    `}};n(oo,"PrepaidButton");var Pp=n((t,e)=>({options:j(e.product.id)(t),shipmentsOptedIn:V(e.product)(t),prepaidShipmentsSelected:te(e.product)(t)}),"mapStateToProps"),Pa=g(Pp,{productChangePrepaidShipments:ye})(oo);var no=class extends W{constructor(){super(),this.options=[],this.text="shipments"}static get properties(){return{...super.properties,text:{type:String}}}static get styles(){return b`
      og-select {
        display: inline-block;
        cursor: pointer;
        background-color: var(--og-select-bg-color, #fff);
        border: var(--og-select-border, 1px solid #aaa);
        border-width: var(--og-select-border-width, 1px);
        box-shadow: 0 1px 0 1px rgba(0, 0, 0, 0.04);
        z-index: 1;
      }
    `}render(){if(this.options.length===0)return u``;let e=this.options.map(r=>({value:r,text:`${r} ${this.text}`}));return u`
      ${this.options.length>1?u`
            <og-select
              .options=${e}
              .selected=${this.selectedNumberOfShipments}
              .onChange="${r=>this.handleSelect(r)}"
            ></og-select>
          `:u`
            <span>${e[0].text}</span>
          `}
      <slot name="append"></slot>
    `}};n(no,"PrepaidSelect");var vp=n((t,e)=>({options:j(e.product.id)(t),shipmentsOptedIn:V(e.product)(t),prepaidShipmentsSelected:te(e.product)(t)}),"mapStateToProps"),va=g(vp,{productChangePrepaidShipments:ye})(no);var io=class extends ft{static get properties(){return{...super.properties,prepaidShipmentsOptedIn:{type:Number}}}get isActive(){return this.prepaidShipmentsOptedIn>0?!1:this.subscribed}handleClick(e){if(!this.isActive){let r=this.frequencies&&this.frequencies.length>0?this.frequencies[0]:this.optinFrequency;this.optinProduct(Mt(this),r,this.offer)}e.preventDefault()}render(){return u`
      <slot name="default">
        <button id="action-trigger" class="btn radio ${this.isActive?" active":""}"></button>
        <label for="action-trigger">
          <slot>
            <slot name="label"><og-text key="offerOptInLabel"></og-text></slot>
          </slot>
        </label>
      </slot>
    `}};n(io,"SubscriptionButton");var Oa=g(Z,{optinProduct:Q})(io);var Ht=class extends x{static get styles(){return b`
      :host {
        position: fixed;
        top: 5em;
        righit: 5em;
        background-color: rgba(255, 255, 255, 0.7);
        width: 400px;
        padding: 1em;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-shadow: 2px 2px 0 0 #000;
      }

      button {
        margin: 0 0.5em 0.5em;
        background-color: gray;
        color: white;
        border: 0;
        border-radius: 3px;
        cursor: pointer;
        padding: 0.5em;
      }

      button.primary {
        background-color: blue;
        padding: 1em;
        color: white;
        border: 0;
        border-radius: 3px;
      }

      button[disabled] {
        background-color: #777;
      }

      div {
        margin-bottom: 0.5em;
      }

      .message {
        margin-left: 0.5em;
        margin: 1em;
      }

      .success {
        color: green;
      }

      .error {
        color: red;
      }

      .warning {
        color: orange;
      }
      a {
        color: white;
      }
    `}runTests(){this.results=[],this.disabled=!0,this.requestUpdate(),document.querySelectorAll("og-offer").forEach(r=>{let o=r.store.getState(),i=r.getAttribute("product"),s=r.getAttribute("location"),a={messages:this.getOfferAttributeMessages(i,s).concat(this.getOfferRequestMessages(i,o)),product:i};this.results.push(a)}),this.testsRan=!0,this.disabled=!1,this.requestUpdate()}getOfferAttributeMessages(e,r){let o=[];return e||o.push({name:"Offer element found but missing product attribute",type:"error"}),r||o.push({name:"Offer element found but missing location attribute",type:"warning"}),e&&r&&o.push({name:"Offer element found and properly tagged",type:"success"}),o}getOfferRequestMessages(e,r){let o=r.inStock[e],i=r.autoshipEligible[e],s=[];return e&&o===!1&&s.push({name:"This product is marked as out of stock in the OG database",type:"warning"}),e&&i===!1&&s.push({name:"This product is not eligible for autoship",type:"warning"}),e&&o===null&&i===null&&s.push({name:"This product does not exist in our database",type:"error"}),s}resultsCodeBlock(){return this.results.length===0?u`
          <div class="message error">No offer element found on the page</div>
        `:this.results.map((e,r)=>u`
            <div>For offer tag with product = "${e.product}"</div>
            ${e.messages.map(o=>u`
                <div class="message ${o.type}">${o.name}</div>
              `)}
            <button @click=${this.toggleProductFlags(r,{})}>Set inStock and eligible</button>
            <br />
            <button @click=${this.toggleProductFlags(r,{inStock:!1})}>Set to not inStock</button>
            <br />
            <button @click=${this.toggleProductFlags(r,{autoship:!1})}>Set to not eligible</button>
            <br />
            <button @click=${this.toggleProductFlags(r,{autoship:!1,inStock:!1})}>
              Set to not eligible and not in stock
            </button>
            <br />
            <button @click=${this.toggleUpsellPreview(r)}>Toggle upsell/regular in this offer</button>
            <br />
            <button @click=${this.toggleUpsellNextOrder(r)}>upsell product is in next order</button>
            <br />
          `)}toggleUpsellPreview(e){return r=>{r.preventDefault();let o=document.querySelectorAll("og-offer")[e];o.getAttribute("preview-upsell-offer")?o.removeAttribute("preview-upsell-offer"):o.setAttribute("preview-upsell-offer",!0),this.runTests()}}toggleProductFlags(e,{inStock:r=!0,autoship:o=!0,groups:i=["subscription","upsell"]}){return s=>{s.preventDefault();let a=document.querySelectorAll("og-offer")[e],c=a.product.id;a.store.dispatch(be({in_stock:{[c]:r},eligibility_groups:{[c]:i},result:"success",autoship:{[c]:o},module_view:{regular:"58a01e9aacbe40389b5c7325d79091bb"},modifiers:{},incentives_display:{"47c01e9aacbe40389b5c7325d79091aa":{field:"sub_total",object:"order",type:"Discount Percent",value:5},e6534b9d877f41e586c37b7d8abc3a58:{field:"total_price",object:"item",type:"Discount Percent",value:5},f35e842710b24929922db4a529eecd40:{field:"total_price",object:"item",type:"Discount Percent",value:10},"5be321d7c17f4e18a757212b9a20bfcc":{field:"total_price",object:"item",type:"Discount Percent",value:1}},incentives:{[c]:{initial:["5be321d7c17f4e18a757212b9a20bfcc"],ongoing:["e6534b9d877f41e586c37b7d8abc3a58","47c01e9aacbe40389b5c7325d79091aa","f35e842710b24929922db4a529eecd40"]}}},{},c)),this.runTests()}}toggleUpsellNextOrder(e){return r=>{let o=document.querySelectorAll("og-offer")[e],i=o.product.id;r.preventDefault(),o.store.dispatch(No({count:1,next:null,previous:null,results:[{order:"24d50352579511ea806cbc764e100cfd",offer:null,subscription:"8a076b7a0ea011e7a5bcbc764e105eda",product:i,components:[],quantity:1,public_id:"24d6901e579511ea806cbc764e100cfd",product_attribute:null,price:"14.99",extra_cost:"0.00",total_price:"13.49",one_time:!1,frozen:!1,first_placed:null}]})),this.runTests()}}render(){return u`
      <div>
        ${this.testsRan?this.resultsCodeBlock():u`
              <div>Click the button to run tests</div>
            `}
        <button ?disabled=${this.disabled} @click="${this.runTests.bind(this)}" class="primary">Run Test</button>
      </div>
    `}};n(Ht,"TestWizard");function pn(){let t="og-test-wizard";customElements.get(t)||customElements.define(t,Ht);let e=document.createElement(t);document.body.appendChild(e)}n(pn,"default");var un=[79,71,68,69,86],Ta=n(()=>{if(window.OG_OFFERS_TEST_MODE_ENABLE)return;window.OG_OFFERS_TEST_MODE_ENABLE=!0;let t=0;document.addEventListener("keyup",async function(e){if(e.which===un[t]){let o=un[t];setTimeout(function(){t<=o&&(t=0)},5e3),t+=1,t>=un.length&&pn()}else t=0},!1)},"enable");var so=class extends N(z){static get properties(){return{...super.properties,regular:{type:Boolean,reflect:!0},subscription:{type:Boolean,reflect:!0},discount:{type:Boolean,reflect:!0},payAsYouGo:{type:Boolean,reflect:!0,attribute:"pay-as-you-go"},frequency:{type:Object},productPlans:{type:Object}}}static get styles(){return b`
      :host::before {
        clip-path: inset(100%);
        clip: rect(1px, 1px, 1px, 1px);
        height: 1px;
        overflow: hidden;
        position: absolute;
        white-space: nowrap;
        width: 1px;
      }

      :host([subscription])::before {
        content: 'Discounted subscription price';
      }

      :host([regular])::before {
        content: 'Regular price';
      }
    `}get value(){var l;let e=S(this.product),r=this.frequency||this.configDefaultFrequency||((l=this.offer)==null?void 0:l.defaultFrequency),o=this.productPlans[e]||[];if(this.payAsYouGo){let p=o.find(d=>d.prepaidShipments===null||d.prepaidShipments===void 0);return p?p.subscriptionPrice:""}let i=o.find(p=>p.frequency===r);if(!i)return"";let{regularPrice:s,discountRate:a,subscriptionPrice:c}=i;return c===s?"":this.regular?s:this.discount?a:c}render(){let e=this.value;return e?u`
        <slot name="prepend"></slot>
        ${e}
        <slot name="append"></slot>
      `:u`
      <slot name="fallback"></slot>
    `}};n(so,"Price");var Tp=n((t,e)=>{var r;return{productPlans:t.productPlans,configDefaultFrequency:oe((r=e.product)==null?void 0:r.id)(t),frequency:re(e.product)(t)}},"mapStateToProps"),wa=g(Tp)(so);function dn(t){Ta(),bs(t);try{customElements.define("og-when",Zs),customElements.define("og-text",ca),customElements.define("og-incentive-text",da),customElements.define("og-offer",_a),customElements.define("og-select-frequency",fa),customElements.define("og-optout-button",ra),customElements.define("og-optin-toggle",aa),customElements.define("og-optin-status",ea),customElements.define("og-optin-button",ta),customElements.define("og-optin-select",na),customElements.define("og-upsell-button",ia),customElements.define("og-frequency-status",oa),customElements.define("og-modal",Vt),customElements.define("og-select",jt),customElements.define("og-tooltip",Gt),customElements.define("og-upsell-modal",sa),customElements.define("og-next-upcoming-order",ma),customElements.define("og-price",wa),customElements.define("og-prepaid-toggle",Ea),customElements.define("og-prepaid-data",xa),customElements.define("og-prepaid-button",Pa),customElements.define("og-prepaid-select",va),customElements.define("og-subscription-button",Oa)}catch{console.info("OG WebComponents already registered, skipping.")}let e=!1,r={store:t,isReady:()=>e,setEnvironment(o){return t.dispatch(Fi(o)),this},setMerchantId(o){return t.dispatch(Ii(o)),this},setAuthUrl(o){return t.dispatch(Ni(o)),this},receiveMerchantSettings(o){return t.dispatch(Hi(o)),this},getProductsForPurchasePost(o=[]){return Lo(t.getState(),o)},getOptins(o=[]){return Lo(t.getState(),o)},clear(){t.dispatch(Ui())},addOptinChangedCallback(o){typeof o=="function"&&document.addEventListener("optin-changed",i=>o(i.detail))},disableOptinChangedCallbacks(){document.addEventListener("optin-changed",o=>o.stopPropagation(),!0)},register(){},previewMode(o){return window.og=window.og||{},o===!1?delete window.og:(window.og.previewMode=!0,console.log("OG Offers preview mode enabled")),this},config(o){return t.dispatch(Mi(o)),this},setLocale(o){return t.dispatch(Li(o)),this},addTemplate(o,i,s){return t.dispatch($i(o,i,s)),this},setTemplates(o){return t.dispatch(Vi(o)),this},setPublicPath(o){return this},resolveSettings(o,i,s,a=t){if(!A.shopify_selling_plans&&o&&i&&s){let c=[];s.product?c.push(s.product):s.cart&&Array.isArray(s.cart.products)&&(c=c.concat(s.cart.products));let l=a.getState(),{sessionId:p}=l;p&&c.forEach(d=>a.dispatch(ko(d))),s.product_discounts&&typeof s.product_discounts=="object"&&a.dispatch({type:We,payload:s.product_discounts})}},initialize(o,i,s,a={}){var l;e&&console.warn("og.offers has been initialized already. Skipping.");let c=t.getState();return o&&o!==c.merchantId&&r.setMerchantId(o),i&&i!==((l=c.environment)==null?void 0:l.name)&&r.setEnvironment(i),r.receiveMerchantSettings(a),s&&r.setAuthUrl(s),e||r.resolveSettings(o,i,window.og_settings,t),e=!0,this}};return window.OG=window.OG||{},Object.assign(window.OG,r),Object.assign(r.initialize,r),Uo(window.opener,r),r}n(dn,"makeApi");var ao=n((t=[],e)=>{switch(e.type){case he:return[];case Te:return e.newValue?e.newValue.optedin:t;case R:case F:{let[{prepaidShipments:r,...o},i]=rt(t,e.payload.product);return i.concat({...o,...e.payload.product,frequency:e.payload.frequency})}case ce:{let{payload:r}=e,[{prepaidShipments:o,...i},s]=rt(t,r.product),a={...i,...r.product};return r.prepaidShipments&&(a.prepaidShipments=r.prepaidShipments),s.concat(a)}case k:return t.filter(r=>!I(e.payload.product,r));case bt:return t.map(r=>I(e.payload.product,r)?{...r,...e.payload.newProduct}:r);case tr:return t.filter(r=>!I(e.payload.product,r));case ze:return[];default:return t}},"optedin"),fn=n((t=[],e)=>{switch(e.type){case he:return[];case Te:return e.newValue?e.newValue.optedout:t;case R:case F:return t.filter(r=>!I(e.payload.product,r));case k:{let[r,o]=rt(t,e.payload.product);return o.concat({...r,...e.payload.product,frequency:e.payload.frequency})}case bt:return t.map(r=>I(e.payload.product,r)?{...r,...e.payload.newProduct}:r);case ze:return[];default:return t}},"optedout"),hn=n((t={},{type:e,payload:r})=>{switch(e){case Qt:return r&&r.count>0?{...t,...r.results[0]&&{...r.results[0],place:new Date(Date.parse(r.results[0].place.replace(/-/gi,"/")))}}:t;case Zt:return{...t,products:(r.results||[]).map(o=>o.product)};case er:return{...t,...r,public_id:r.order,...r.product&&{products:(t.products||[]).concat(r.product)}};default:return t}},"nextUpcomingOrder"),wp=n((t={},e)=>{switch(e.type){case w:return{...t,...e.payload.autoship};default:return t}},"autoshipEligible"),Cp=n((t={},e)=>{switch(e.type){case q:return{...t};case w:return{...t,...e.payload.in_stock};default:return t}},"inStock"),mn=n((t={},e)=>{switch(e.type){case w:return{...t,...e.payload.eligibility_groups};default:return t}},"eligibilityGroups"),Ca=n((t,e)=>t.map(r=>({...e[r],id:[r][0]})),"mapIncentive"),gn=n((t={},e)=>{switch(e.type){case w:return{...t,...[...new Set(Object.keys(e.payload.incentives||{}))].reduce((r,o)=>({...r,[o]:Object.entries(e.payload.incentives).filter(([i])=>i===o).reduce((i,[,{initial:s,ongoing:a}])=>({...i,initial:[...i.initial||[],...Ca(s,e.payload.incentives_display)],ongoing:[...i.ongoing||[],...Ca(a,e.payload.incentives_display)]}),{})}),{})};default:return t}},"incentives"),Rp=n((t={},e)=>{switch(e.type){case R:case F:return{...t,[S(e.payload.product)]:e.payload.frequency};case k:return{...t,[S(e.payload.product)]:void 0};default:return t}},"frequency"),yn=n((t=!1,e)=>{switch(e.type){case Jt:return{...e.payload};case Oe:return!1;default:return t}},"auth"),bn=n((t="",e)=>{switch(e.type){case $e:return e.payload;default:return t}},"merchantId"),Sn=n((t=null,e)=>{switch(e.type){case Kt:return e.payload;default:return t}},"authUrl"),Ap=n((t={},e)=>{switch(e.type){case w:return{...t,offerId:(e.payload.module_view||{}).regular,...e.payload.modifiers};default:return t}},"offer"),_n=n((t="",e)=>{switch(e.type){case w:return(e.payload.module_view||{}).regular||"";default:return t}},"offerId"),En=n((t=null,e)=>{switch(e.type){case he:return null;case Ve:return e.payload;default:return t}},"sessionId"),Ip=n((t={},e)=>{switch(e.type){case w:return{...t,...Object.entries(e.payload.autoship).map(([r])=>({[r]:Object.keys(e.payload.modifiers)})).reduce((r,o)=>({...r,...o}),{})};case ze:return{};default:return t}},"productOffer"),xn=n((t={},e)=>{switch(e.type){case ir:return{...t,[S(e.payload.product)]:e.payload.firstOrderPlaceDate};default:return t}},"firstOrderPlaceDate"),Pn=n((t={},e)=>{switch(e.type){case sr:return{...t,[S(e.payload.product)]:e.payload.productToSubscribe};default:return t}},"productToSubscribe"),vn=n((t={},e)=>{switch(e.type){case je:return{...t,name:"local",apiUrl:"http://py3web.ordergroove.localhost",legoUrl:"http://py3lego.ordergroove.localhost"};case Ge:return{...t,name:we,apiUrl:"https://staging.offers.ordergroove.com",legoUrl:"https://staging.restapi.ordergroove.com"};case He:return{...t,name:ar,apiUrl:"https://dev.offers.ordergroove.com",legoUrl:"https://dev.restapi.ordergroove.com"};case Be:return{...t,name:Ce,apiUrl:"https://offers.ordergroove.com",legoUrl:"https://restapi.ordergroove.com"};default:return t}},"environment"),On=n((t={offerOptInLabel:"Subscribe to save",offerIncentiveText:"Save {{ogIncentive DiscountPercent}} when you subscribe",offerOptOutLabel:"Deliver one-time only",offerEveryLabel:"Delivery Every",offerTooltipTrigger:"[?]",offerTooltipContent:"Seems this is a great subscription offering. Many fun details about this program exist.",optinButtonLabel:"\u2022",optoutButtonLabel:"\u2022",optinStatusOptedInLabel:"You're opted in!",optinStatusOptedOutLabel:"You're not opted in.",optinToggleLabel:"\u2022",upsellButtonLabel:"Add item to order on ",upsellButtonPrefix:"",upsellModalContent:"Some upsell modal content",upsellModalOptInLabel:"Subscribe",upsellModalOptOutLabel:"Purchase one time",upsellModalTitle:"Impulse Upsell",upsellModalConfirmLabel:"Ok",upsellModalCancelLabel:"Cancel",defaultFrequencyCopy:"(Most Popular)",frequencyPeriods:{1:"day",2:"week",3:"month"},prepaidOptInLabel:"Prepaid Subscription",prepaidShipmentsLabel:"Number of prepaid shipments"},e)=>{switch(e.type){case rr:return{...t,...e.payload};default:return t}},"locale"),Np=n((t={offerType:"radio"},e)=>{switch(e.type){case Ye:return{...t,...e.payload,defaultFrequency:e.payload.defaultFrequency?Tt(e.payload.defaultFrequency):t.defaultFrequency,frequenciesEveryPeriod:[],frequencies:e.payload.frequencies?e.payload.frequencies.map(Tt):t.frequencies};case le:return{...t,merchantSettings:{...e.payload}};default:return t}},"config"),Tn=n((t=!1,e)=>{switch(e.type){case fe:return e.payload.isPreview;default:return t}},"previewStandardOffer"),wn=n((t=!1,e)=>{switch(e.type){case _t:return e.payload.isPreview;default:return t}},"previewUpsellOffer");var Cn=n((t={},e)=>{switch(e.type){case w:return{...t,...e.payload.autoship_by_default};default:return t}},"autoshipByDefault"),Rn=n((t=[],e)=>{switch(e.type){case w:return{...t,...e.payload.default_frequencies};default:return t}},"defaultFrequencies"),An=n((t=[],e)=>{switch(e.type){case nr:return[...e.payload||[]];case or:return[e.payload,...t];default:return t}},"templates"),kp=n((t={},e)=>{switch(e.type){case We:return Nr(e.payload);default:return t}},"productPlans"),In=n((t={},e)=>{switch(e.type){case St:{let{[e.payload.oldCartProductKey]:r,...o}=t;return{...o,[e.payload.newCartProductKey]:r}}case ce:return e.payload.prepaidShipments?{...t,[e.payload.product.id]:e.payload.prepaidShipments}:t;default:return t}},"prepaidShipmentsSelected"),co=Bt({optedin:ao,optedout:fn,nextUpcomingOrder:hn,autoshipEligible:wp,inStock:Cp,eligibilityGroups:mn,incentives:gn,frequency:Rp,auth:yn,merchantId:bn,authUrl:Sn,offer:Ap,offerId:_n,experiments:Rr,sessionId:En,productOffer:Ip,firstOrderPlaceDate:xn,productToSubscribe:Pn,environment:vn,locale:On,config:Np,previewStandardOffer:Tn,previewUpsellOffer:wn,autoshipByDefault:Cn,defaultFrequencies:Rn,templates:An,productPlans:kp,prepaidShipmentsSelected:In});var lo=n(t=>{var e,r;return Array.isArray((e=t.selling_plan)==null?void 0:e.options)&&((r=t.selling_plan)==null?void 0:r.options.some(o=>(o==null?void 0:o.name)==="Shipment amount"))},"isPrepaidAllocation"),po=n(t=>{if(t&&t.length>1){let e=t.find(r=>(r==null?void 0:r.name)==="Shipment amount").value.split(" ");return e.length>0?+e[0]:null}return null},"getPrepaidShipmentsNumberFromOptions"),Fp=n(t=>{var e,r;return(t.selling_plan_id||((r=(e=t.selling_plan)==null?void 0:e.id)!=null?r:"")).toString()},"getAllocationFrequency"),qp=n((t,e)=>ue(t.compare_at_price,e),"getAllocationRegularPrice"),Dp=n((t,e)=>{var r;if(lo(t)){let o=po((r=t.selling_plan)==null?void 0:r.options),i=Math.round(t.price/o);return ue(i,e)}return ue(t.price,e)},"getAllocationSubscriptionPrice"),Ra=n((t,e)=>Math.round((t.compare_at_price-e)*100/t.compare_at_price),"getPrepaidPercentage"),Up=n((t,e)=>{var o,i,s;if(lo(t)){let a=po((o=t.selling_plan)==null?void 0:o.options),c=t.price/a,l=Ra(t,c);return vr(l)}let r="";return((i=t.price_adjustments[0])==null?void 0:i.value_type)==="percentage"?r=vr(t.price_adjustments[0].value):(s=t.price_adjustments[0])!=null&&s.value?r=ue(t.price_adjustments[0].value,e):t.compare_at_price&&(r=ue(t.compare_at_price-t.price,e)),r},"getAllocationDiscountRate"),Lp=n(t=>{var e;return lo(t)?po((e=t.selling_plan)==null?void 0:e.options):null},"getAllocationNumberOfShipments"),Mp=n((t,e,r,o)=>{var d,f;let i=po((d=t.selling_plan)==null?void 0:d.options),s=t.price/i,a=t.compare_at_price-s,c=Ra(t,s),l=(f=r==null?void 0:r.price_adjustments)==null?void 0:f[0],p=l&&l.value_type==="percentage"?l.value:null;return e.regularPrepaidPrice=ue(t.price,o),e.prepaidSavingsPerShipment=ue(Math.round(a),o),e.prepaidSavingsTotal=ue(Math.round(a*i),o),p&&c&&(e.prepaidExtraSavingsPercentage=vr(c-p)),e},"addPrepaidPriceAndSavings"),$p=n((t,e,r)=>{t.selling_plan||(t.selling_plan=e.find(i=>i.id===t.selling_plan_id));let o={frequency:Fp(t),regularPrice:qp(t,r),subscriptionPrice:Dp(t,r),discountRate:Up(t,r),prepaidShipments:Lp(t)};if(lo(t)){let i=us(e);return Mp(t,o,i,r)}return o},"mapSellingPlanToDiscount"),Nn=n((t,e,r=[],o)=>[...t,$p(e,r,o)],"sellingPlanAllocationsReducer"),Aa=n(t=>t.selling_plan_groups.reduce((e,r)=>[...e,...r.selling_plans.map(o=>({...o,group:r}))],[]),"getSellingPlans");var Vp=n((t={offerType:"radio",productFrequencies:{},frequencies:[],frequenciesEveryPeriod:[]},e)=>{var r;if(D===e.type){let{payload:{product:o,currency:i}}=e,s={},a=(r=o.variants)==null?void 0:r.reduce((p,d)=>Gp(p,d,o.selling_plan_groups,t),{}),c={...t.productFrequencies,...a};s={...s,productFrequencies:c,...Object.values(c)[0]};let l=o==null?void 0:o.selling_plan_groups.filter(p=>/^Prepaid-.*/.test(p.name));return l.length&&(s={...s,prepaidSellingPlans:{...t.prepaidSellingPlans,...Bp(l)}}),{...t,...s,storeCurrency:i}}if(w===e.type){let{payload:{offer:o}}=e,{defaultFrequency:i,product:s}=o||{},{prepaidSellingPlans:a={}}=t,c=S(s==null?void 0:s.id),l=t.productFrequencies[c],p={...t.productFrequencies,[c]:{...l,defaultFrequency:Hp(c,i,a,l==null?void 0:l.frequencies,l==null?void 0:l.frequenciesEveryPeriod)}};return{...t,productFrequencies:p,...Object.values(p)[0]}}return le===e.type?{...t,merchantSettings:{...e.payload}}:t},"config");function jp(t,e){var i,s;let r=Ft(t),o=Tr(r);if(o!=null&&o.length){let a=wr(r),c=((s=(i=r.options)==null?void 0:i[0])==null?void 0:s.values)||o,l=e==null?void 0:e.defaultFrequency;return l&&Ie(l)&&(l=J(o,a,l)||pe(o)||l),{frequencies:o,frequenciesEveryPeriod:a,frequenciesText:c,...l?{defaultFrequency:l}:{}}}return null}n(jp,"getFrequencies");function Gp(t,e,r,o){let i=e.selling_plan_allocations.map(c=>c.selling_plan_group_id),s=r.filter(c=>i.includes(c.id)),a=jp(s,o.productFrequencies[e.id]);return a&&(t[e.id]=a),t}n(Gp,"reduceSellingPlansToFrequencies");function Hp(t,e,r,o=[],i=[]){var s;return(s=r[t])!=null&&s.some(({sellingPlan:a})=>a===e)?pe(o)||e:Ie(e)&&(J(o,i,e)||pe(o))||e}n(Hp,"getUpdatedDefaultFrequency");function Bp(t){return t.reduce((e,r)=>{let o=r.name.split("-")[1],i=r.selling_plans.map(s=>({numberShipments:Cr(s),sellingPlan:String(s.id)}));return{...e,[o]:i}},{})}n(Bp,"getPrepaidSellingPlans");var Ia=Vp;var ka=n((t,e,r)=>{let o=Object.keys(t).filter(i=>i.startsWith(e.toString()));return o.length?{...t,...o.reduce((i,s)=>({...i,[s]:r}),{})}:t},"overrideLineKey"),Na=n((t,e,r)=>{if(!r)return null;if(!Ie(r))return r;if(yr(t,e)){let o=J(t,e,r);return o||pe(t)}return r},"getDefaultSellingPlan"),zp=n((t,e,r)=>t.map(o=>Ie(o==null?void 0:o.frequency)?{...o,frequency:yr(r==null?void 0:r.frequencies,r==null?void 0:r.frequenciesEveryPeriod)?J(r==null?void 0:r.frequencies,r==null?void 0:r.frequenciesEveryPeriod,o.frequency)||J(r==null?void 0:r.frequencies,r==null?void 0:r.frequenciesEveryPeriod,e==null?void 0:e.defaultFrequency)||pe(r==null?void 0:r.frequencies):o.frequency}:o),"mapExistingOptinsFromOfferResponse"),Yp=n(({autoship:t={},autoship_by_default:e={},default_frequencies:r={},in_stock:o={}},i,s,a)=>Object.keys(t).reduce((c,l)=>{if(!i.some(p=>p.id===l)){if(!(t[l]&&e[l]&&o[l]))return c;let{frequencies:p,frequenciesEveryPeriod:d}=a,{defaultFrequency:f}=s||{},h=r[l],_;return r[l]&&yr(p,d)?_=J(p,d,`${h.every}_${h.every_period}`)||Na(p,d,f)||pe(p):r[l]?_=`${h.every}_${h.every_period}`:_=Na(p,d,f)||"_",c.concat({id:l,frequency:_})}return c},[]),"reduceNewOptinsFromOfferResponse"),Wp=n((t,e)=>({...ka(t,e.id,e.available),[e.id]:e.available}),"productOrVariantInStockReducer"),Fa=n((t,e)=>{let r=S(e.key);return{...t,[e.key]:t[r]||null}},"reduceProductCartLine"),Kp=n((t={},e)=>{var r;if(me===e.type){let{payload:o}=e;return o.items.reduce(Fa,t)}if(D===e.type){let{payload:{product:o}}=e,i=cs(o==null?void 0:o.selling_plan_groups),s=new Set((r=i.flatMap(a=>a.selling_plans.map(c=>c.id)))!=null?r:[]);return o.variants.reduce((a,c)=>{var d,f;let p=((f=(d=c==null?void 0:c.selling_plan_allocations)==null?void 0:d.filter(h=>s.has(h.selling_plan_id)))!=null?f:[]).length>0;return{...ka(a,c.id,p),[c.id]:p}},t)}return fe===e.type?e.payload.isPreview!==!0?t:{...t,[e.payload.productId]:!0}:t},"autoshipEligible"),Jp=n((t={},e)=>{var r;if(me===e.type)return e.payload.items.reduce(Fa,t);if(D===e.type){let{payload:{product:o}}=e;return[o,...(r=o==null?void 0:o.variants)!=null?r:[]].reduce(Wp,t)||t}return q===e.type&&e.payload.product===null?{...t}:fe===e.type?e.payload.isPreview!==!0?t:{...t,[e.payload.productId]:!0}:t},"inStock"),Qp=n((t={},e)=>t,"offer");function Zp(t){let e=Cr(t.selling_plan_allocation.selling_plan),r={id:t.key,frequency:`${t.selling_plan_allocation.selling_plan.id}`};return e&&(r.prepaidShipments=e),r}n(Zp,"getOptedInItem");var Xp=n((t=[],e)=>{if(me===e.type){let r=e.payload;return t.filter(o=>!o.id.includes(":")).concat(r.items.reduce((o,i)=>i.selling_plan_allocation?[...o,Zp(i)]:o,[]))}if(w===e.type){let r=e.payload,{offer:o={},frequencyConfig:i}=r,s=zp(t,o,i),a=Yp(r,s,o,i);return[...s,...a]}if(D===e.type){let{product:r}=e.payload,o=Ft(r==null?void 0:r.selling_plan_groups);if(!o)return t;let i=Tr(o),s=wr(o);return t.map(a=>Ie(a.frequency)?{...a,frequency:J(i,s,a.frequency)||pe(i)}:a)}if(ce===e.type){let{payload:r}=e,o=ao(t,e),[i,s]=rt(o,r.product);return s.concat({...i,...r.product,frequency:r.frequency})}return ao(t,e)},"optedin"),eu=n((t={},e)=>t,"productOffer"),tu=n((t={},e)=>{if(D===e.type){let{payload:{product:r,currency:o}}=e,i=Aa(r);return r.variants.reduce((s,a)=>{var c;return{...s,[a.id]:(c=a.selling_plan_allocations)==null?void 0:c.reduce((l,p)=>Nn(l,p,i,o),[])}},t)||t}if(me===e.type){let r=e.payload;return r.items.reduce((o,i)=>i.selling_plan_allocation?{...o,[i.key]:Nn([],i.selling_plan_allocation,[],r.currency)}:o,t)||t}return t},"productPlans"),ru=Bt({auth:yn,authUrl:Sn,autoshipByDefault:Cn,autoshipEligible:Kp,config:Ia,defaultFrequencies:Rn,eligibilityGroups:mn,environment:vn,firstOrderPlaceDate:xn,incentives:gn,inStock:Jp,locale:On,merchantId:bn,nextUpcomingOrder:hn,offer:Qp,offerId:_n,experiments:Rr,optedin:Xp,optedout:fn,previewStandardOffer:Tn,previewUpsellOffer:wn,productOffer:eu,productPlans:tu,productToSubscribe:Pn,sessionId:En,templates:An,prepaidShipmentsSelected:In});function kn(t,e){return window.og&&window.og.previewMode?co(t,e):ru(t,e)}n(kn,"shopifyReducer");var La=ae(xt()),Ma=ae(Yt());function qa(t,e,r){let o=`[name="id"][value="${t}"]`,i=`form[action="/cart/add"] option[value="${t}"]`;if(!e)return;let s=document.querySelectorAll(o);s.length||(s=document.querySelectorAll(i)),[...s].forEach(a=>{let c=a.form,l=c==null?void 0:c.querySelector(`[name="${e}"]`);l||(l=document.createElement("input"),l.type="hidden",l.name=`attributes[${e}]`,c==null||c.appendChild(l)),l.value=r})}n(qa,"updateTrackingInputs");function Fn(){return`og__${Math.ceil(new Date().getTime()/1e3)}`}n(Fn,"getTrackingKey");function ou(t,e){var d,f,h,_;if(!((d=t.payload.offer)==null?void 0:d.autoshipByDefault))return;let o=(f=t.payload.offer)==null?void 0:f.product.id,i=Fn(),s=((h=t.payload.offer)==null?void 0:h.location)||"",a=((_=t.payload.offer)==null?void 0:_.variationId)||"",c=uo(o,e),p=[o,R.toLowerCase(),s,c,a].join(",");qa(o,i,p)}n(ou,"addDefaultToSubTracking");function qn(t){return e=>r=>{switch(e(r),r.type){case R:case k:case F:{let o=r.payload.offer,i=Dn(r);o&&!o.isCart&&qa(o.product.id,i[0],i[1]);break}case w:ou(r,t);break;default:}}}n(qn,"shopifyTrackingMiddleware");var Da,Ua,Un=((Ua=(Da=window.Shopify)==null?void 0:Da.routes)==null?void 0:Ua.root)||"/",nu="/cart",iu=`${Un}cart.js`,su=`${Un}cart/change.js`,au=`${Un}products/`,cu='[id^="shopify-section-"][id$=__cart-items], [id^="shopify-section-"][id$="__cart-footer"],#cart-live-region-text,#cart-icon-bubble',lu=n(t=>(0,Ma.debounce)(100,!1,function(e){let{id:r}=Object.fromEntries([...new FormData(e).entries()]);r?t.setAttribute("product",r):t.removeAttribute("product")}),"makeSyncProductId");async function pu(){var r,o;let t=(o=(r=window.Shopify)==null?void 0:r.currency)==null?void 0:o.active;return t||(await Ln()).currency}n(pu,"getCurrency");async function uu(t,e){let r=du(e);if(r)try{let[i,s]=await Promise.all([$a(r),pu()]),a={product:i,offer:e,currency:s};t.dispatch({type:D,payload:a})}catch(i){console.warn("OG: Unable to fetch product details for PDP",i)}let o=e.closest("form");if(!o){let i=e.parentElement;for(;i&&(o=i.querySelector('form[action$="/cart/add"]'),!(o||i.tagName.toLowerCase()==="body"));)i=i.parentElement}if(o){let i=lu(e);o.addEventListener("change",()=>i(o)),new MutationObserver(()=>i(o)).observe(o,{subtree:!0,childList:!0})}else console.info("no /cart/add form found for og-offer",e)}n(uu,"setupPdp");async function Ln(){return(await fetch(iu)).json()}n(Ln,"getCart");function du(t){return[()=>t==null?void 0:t.dataset.shopifyProductHandle,()=>{var e,r;return(((r=(e=document.querySelector('[href$=".oembed"]'))==null?void 0:e.getAttribute("href"))==null?void 0:r.match(/\/([^/]+)\.oembed$/))||[])[1]},()=>{var e,r;return(document.querySelector('meta[property="og:type"][content="product"]')&&((r=(e=document.querySelector('meta[property="og:url"][content]'))==null?void 0:e.getAttribute("content"))==null?void 0:r.match(/\/([^/]+)$/))||[])[1]},()=>{var e;return(e=[...document.querySelectorAll("[type$=json]")].map(r=>JSON.parse(r.textContent||"{}")).find(r=>r.handle&&r.price))==null?void 0:e.handle}].reduce((e,r)=>e||r(),"")}n(du,"guessProductHandle");var $a=(0,La.default)(async function(t){return(await fetch(`${au}${t}.js`)).json()});async function fu(t,e){let r=await Ln(),{items:o}=r,i=r;t.dispatch({type:me,payload:i});let s=Number(e.product.id);s<=o.length&&e.setAttribute("product",o[s-1].key),(await Promise.all(Array.from(new Set(o.map(({handle:c})=>c))).map($a))).forEach(c=>{let l={product:c,offer:e,currency:r.currency};t.dispatch({type:D,payload:l})})}n(fu,"setupCart");async function hu(t,e){var s,a;let r=t.payload.offer,o=t.payload.frequency||uo(t.payload.product.id,e),i=Dn(t);if(!!(r!=null&&r.isCart))try{r.style.pointerEvents="none",r.style.opacity=".7";let c=Array.from(document.querySelectorAll(cu)),l=t.payload.product.id,p=await Ln(),d=(s=p==null?void 0:p.items)==null?void 0:s.findIndex(C=>C.key===l),f=p.items[d],h=f.quantity,_=S(l),P=await fetch(su,{method:"POST",credentials:"same-origin",headers:{"Content-Type":"application/json"},body:JSON.stringify({id:l,quantity:h,attributes:Object.fromEntries([i]),properties:f.properties,selling_plan:o||null,sections:c.map(C=>C.id.replace(/^shopify-section-/,""))})});if(P.status!==200)throw new Error("Cart not updated");let m=await P.json(),E=p.items.length===m.items.length?m.items[d].key:(a=m.items.find(C=>C.quantity===h&&C.product_id===_&&(!o&&!C.selling_plan_allocation||(C==null?void 0:C.selling_plan_allocation.selling_plan.id)===o)))==null?void 0:a.key;E&&(e.dispatch({type:St,payload:{oldCartProductKey:l,newCartProductKey:E}}),r.setAttribute("product",E));let T=m;e.dispatch({type:me,payload:T});let y=new CustomEvent(li,{bubbles:!0,cancelable:!0});if(r.dispatchEvent(y),y.defaultPrevented)return;let O=m.sections;Object.values(O).length?c.forEach(C=>{let $n=C.id.replace(/^shopify-section-/,"");if(!($n in O))return;let za=O[$n],Vn=new DOMParser().parseFromString(za.toString()||"","text/html").getElementById(C.id);Vn&&(C.innerHTML=Vn.innerHTML)}):window.location.pathname.startsWith(nu)&&window.location.reload()}catch(c){console.log("OG Error updating cart",c)}finally{r.style.pointerEvents="auto",r.style.opacity="1"}}n(hu,"synchronizeCartOptin");function Dn(t){var a,c;let e=t.payload.product.id;if(!e)return[];let r=Fn(),o=((a=t.payload.offer)==null?void 0:a.location)||"",i=((c=t.payload.offer)==null?void 0:c.variationId)||"",s=[e,t.type.toLowerCase(),o];switch(t.type){case q:case k:s.push(""),s.push(i);break;case R:case F:s.push(t.payload.frequency),s.push(i);break;default:return[]}return[r,s.join(",")]}n(Dn,"getTrackingEvent");function uo(t,e){var i;return(i=hr({id:t})(e.getState()))==null?void 0:i.frequency}n(uo,"getSubscribedFrequency");function mu(t,e){e!=null&&e.isCart||!(e!=null&&e.shouldEnableOffer)||[...document.querySelectorAll('form[action$="/cart/add"] [name=id]')].forEach(r=>{let o=r.value,i=uo(o,t);Ro(r.form,"selling_plan",i),Ro(r.form,"attributes[og__session]",t.getState().sessionId)})}n(mu,"synchronizeSellingPlan");function Mn(t){return e=>r=>{var o;switch(r.type){case R:case k:case F:break;case q:(o=r.payload.offer)!=null&&o.isCart?fu(t,r.payload.offer):uu(t,r.payload.offer);break;default:}switch(e(r),r.type){case R:case k:case F:case ce:hu(r,t);case q:case w:case D:mu(t,r.payload.offer);break;default:}}}n(Mn,"shopifyMiddleware");var gu="/apps/subscriptions/auth/",Va="og_auth_begin",yu="og_auth_end",bu=n(t=>{let[e,r,o,i]=atob(t).split("|");return{id:e,signature:o,timestamp:r,email:i}},"parseIntegrationTempAuth");async function ja({store:t}){var i;let[e]=Co(),r=wt(),o=r!=null&&r.dataset.customer?bu(r.dataset.customer):(i=window.ogShopifyConfig)==null?void 0:i.customer;if(o){let s=await _u(o);if(s){let[a,c,l]=s.split("|");t.dispatch(At(e,a,Number(c),l))}}else Ci("og_auth")}n(ja,"authorizeShopifyCustomer");async function Su(t){try{let r=await(await fetch(`${gu}?customer=${t.id}&customer_signature=${t.signature}&customer_timestamp=${t.timestamp}`)).text(),o=r.lastIndexOf(Va);if(o<0)throw"Invalid response from OG auth endpoint";return JSON.parse(r.substring(o+Va.length,r.lastIndexOf(yu)))}catch(e){console.error(e)}}n(Su,"fetchOGSignature");async function _u(t){let e=Ri("og_auth");if(e)return e;let{customerId:r,timestamp:o,signature:i}=await Su(t);if(!r)return"";let s=new Date,a=btoa(i);s.setTime(s.getTime()+2*60*60*1e3);let c=`${r}|${o}|${a};expires=${s.toUTCString()}`;return document.cookie=`og_auth=${c};secure;path=/`,c}n(_u,"getOrCreateAuthCookie");var Ga,Ba=hs(...(Ga=A)!=null&&Ga.shopify_selling_plans?[kn,Mn]:[co],A.shopify&&qn),v=dn(Ba),Eu=v.isReady,xu=v.addOptinChangedCallback,Pu=v.addTemplate,vu=v.clear,Ou=v.config,Tu=v.disableOptinChangedCallbacks,wu=v.getOptins,Cu=v.getProductsForPurchasePost,Ru=v.initialize,Au=v.previewMode,Iu=v.register,Nu=v.resolveSettings,ku=v.setAuthUrl,Fu=v.setEnvironment,qu=v.setLocale,Du=v.setMerchantId,Uu=v.setPublicPath,Lu=v.setTemplates,Mu=v.setupCart,$u=v.setupProduct,Vu=v.setupProducts,ju=n(()=>wi(v),"autoInit");var Gu=v.initialize,Ha;(Ha=A)!=null&&Ha.shopify_selling_plans&&gr(()=>ja(v));return Za(Hu);})();
; return lib; });
//# sourceMappingURL=offers.js.map

var og=window.og||{};og.offers=og.offers||"undefined"!=typeof module&&module.exports,og.offers.initialize("d9e0963334254858b90cf68389c2aace","prod",void 0,{currency_code:"USD",multicurrency_enabled:!1}).setTemplates([{id:"fe649254",markup:'<og-when test="subscriptionEligible">\n    <og-optin-toggle>\n        <div slot="default">\n            <button class="og-button-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"\n                    viewBox="0 0 24 24">\n                    <path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z" />\n                </svg></button>\n            Subscribe to save\n            <og-price regular class="italic line-through"></og-price>\n            <og-price subscription></og-price>\n        </div>\n    </og-optin-toggle>\n    <div>\n        Deliver Every\n        <og-select-frequency default-text="(Recommended)">\n          <option value="1_3" >\n            1 month\n          </option>\n          <option value="2_3" >\n            2 months\n          </option>\n          <option value="3_3" selected="selected"\n            >\n            3 months\n          </option>\n          <option value="4_3" >\n            4 months\n          </option>\n          <option value="5_3" >\n            5 months\n          </option>\n          <option value="6_3" >\n            6 months\n          </option>\n        </og-select-frequency>\n    </div>\n</og-when>',selector:'[location="cart"]'},{id:"389ad71f",markup:'<og-when test="regularEligible">\n    <div class="og-regular-offer-content">\n        <div>\n            <og-optout-button>\n                One Time Purchase\n            </og-optout-button>            <og-price regular></og-price>\n        </div>\n        <div>\n            <og-optin-button>\n                Make It a Routine\n            </og-optin-button>            <og-price regular class="italic line-through"></og-price>\n            <og-price subscription></og-price>\n            \n            <og-tooltip placement="bottom" >\n                <span slot="trigger"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"\n    width="20" height="20"\n    viewBox="0 0 32 32"\n    style=" fill: #000000;"\n>\n    <path d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M16,21h-2v-7h2V21z M15,11.5 c-0.828,0-1.5-0.672-1.5-1.5s0.672-1.5,1.5-1.5s1.5,0.672,1.5,1.5S15.828,11.5,15,11.5z"></path>\n</svg></span>\n                <span slot="content">Subscribe to this product and have it conveniently delivered to you at the frequency you choose. Promotion subject to change.</span>\n            </og-tooltip>\n        </div>\n    </div>\n    <div style="margin-left: 2.2em">\n        <div class="og-offer-incentive">\n        \t<svg\n        \theight="1em"\n        \twidth="1em"\n        \tviewBox="0 0 24 24"\n        \tfill="none"\n        \txmlns="http://www.w3.org/2000/svg"\n        \t>\n        \t<path\n        \t\td="M20,8 C18.5343681,5.03213345 15.4860999,3 11.9637942,3 C7.01333514,3 3,7.02954545 3,12 M4,16 C5.4656319,18.9678666 8.51390007,21 12.0362058,21 C16.9866649,21 21,16.9704545 21,12 M9,16 L3,16 L3,22 M21,2 L21,8 L15,8"\n        \t\tstroke="currentColor"\n        \t\tstroke-width="2"\n        \t></path>\n        \t</svg>\n        \tGet <og-incentive-text from="DiscountPercent"></og-incentive-text> off today and all future orders.\n        </div>        <og-text key="offerEveryLabel">\n            Deliver Every: \n        </og-text>\n        <og-select-frequency default-text="(Recommended)">\n          <option value="1_3" >\n            1 month\n          </option>\n          <option value="2_3" >\n            2 months\n          </option>\n          <option value="3_3" selected="selected"\n            >\n            3 months\n          </option>\n          <option value="4_3" >\n            4 months\n          </option>\n          <option value="5_3" >\n            5 months\n          </option>\n          <option value="6_3" >\n            6 months\n          </option>\n        </og-select-frequency>\n    </div>\n</og-when>\n<og-when test="upsellEligible">\n    <og-when test="!upcomingOrderContainsProduct">\n        Add to upcoming subscription order and receive 20% off\n        <og-upsell-button>\n            <button type="button">\n                Add to Next Order on \n                <og-next-upcoming-order format="{{month-short}} {{day}}, {{year-numeric}}">\n                    </og-nextupcoming-order>\n            </button>\n        </og-upsell-button>\n\n        <og-upsell-modal>\n            Subscribe to this product and have it conveniently delivered to you at the frequency you choose. Promotion subject to change.\n            <br />\n            <og-when test="subscriptionEligible">\n              <og-optout-button>\n                  Get one-time\n              </og-optout-button>\n              <br />\n              <og-optin-button>\n                  Subscribe and get 10% off on every order\n              </og-optin-button>\n              Deliver Every: \n              <og-select-frequency default-text="(Recommended)">\n                <option value="1_3" >\n                  1 month\n                </option>\n                <option value="2_3" >\n                  2 months\n                </option>\n                <option value="3_3" selected="selected"\n                  >\n                  3 months\n                </option>\n                <option value="4_3" >\n                  4 months\n                </option>\n                <option value="5_3" >\n                  5 months\n                </option>\n                <option value="6_3" >\n                  6 months\n                </option>\n              </og-select-frequency>\n            </og-when>\n            <og-when test="!subscriptionEligible">\n              <og-next-upcoming-order format="{{month-short}} {{day}}, {{year-numeric}}">              \n            </og-when>\n            <br />\n            <span slot="confirm">\n                <button type="button">Add</button>\n            </span>\n            <span slot="cancel">\n                <button type="button">Cancel</button>\n            </span>\n        </og-upsell-modal>\n    </og-when>\n\n    <og-when test="upcomingOrderContainsProduct">\n       <og-next-upcoming-order format="{{month-short}} {{day}}, {{year-numeric}}">\n        </og-nextupcoming-order>\n    </og-when>\n</og-when>',selector:'[location="category"]'},{id:"49ca3c3e",markup:'<og-when test="regularEligible">\r\n    <div class="og-regular-offer-content">\r\n        <div>\r\n            <og-optin-button class="og-subscription">\r\n                Make It A Routine\r\n\t\t\t\t<og-price regular class="italic line-through"></og-price>\r\n\t\t\t\t<og-price subscription></og-price>\r\n\t\t\t\t<div style="margin-left: 2rem;">\r\n\t\t\t\t\t<div class="og-offer-incentive">\r\n\t\t\t\t\t\tSave <og-incentive-text from="DiscountPercent"></og-incentive-text>, free shipping. Pause or cancel anytime.\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class="og-optin-buttons">\r\n\t\t\t\t\t\t<div class="og-optin-button-item">\r\n\t\t\t\t\t\t\t<og-optin-button default-frequency="1_3" class="og-subscription-option">\r\n\t\t\t\t\t\t\t\t<span slot=\'default\'>\r\n\t\t\t\t\t\t\t\t\t1 Month\r\n\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t</og-optin-button>\r\n\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t<div class="og-optin-button-item">\r\n\t\t\t\t\t\t\t<og-optin-button default-frequency="2_3" class="og-subscription-option">\r\n\t\t\t\t\t\t\t\t<span slot=\'default\'>\r\n\t\t\t\t\t\t\t\t\t2 Months\r\n\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t</og-optin-button>\r\n\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t<div class="og-optin-button-item">\r\n\t\t\t\t\t\t\t<og-optin-button default-frequency="3_3" class="og-subscription-option">\r\n\t\t\t\t\t\t\t\t<span slot=\'default\'>\r\n\t\t\t\t\t\t\t\t\t3 Months\r\n\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t</og-optin-button>\r\n\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t<div class="og-optin-button-item">\r\n\t\t\t\t\t\t\t<og-optin-button default-frequency="4_3" class="og-subscription-option">\r\n\t\t\t\t\t\t\t\t<span slot=\'default\'>\r\n\t\t\t\t\t\t\t\t\t4 Months\r\n\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t</og-optin-button>\r\n\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t<div class="og-optin-button-item">\r\n\t\t\t\t\t\t\t<og-optin-button default-frequency="5_3" class="og-subscription-option">\r\n\t\t\t\t\t\t\t\t<span slot=\'default\'>\r\n\t\t\t\t\t\t\t\t\t5 Months\r\n\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t</og-optin-button>\r\n\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t<div class="og-optin-button-item">\r\n\t\t\t\t\t\t\t<og-optin-button default-frequency="6_3" class="og-subscription-option">\r\n\t\t\t\t\t\t\t\t<span slot=\'default\'>\r\n\t\t\t\t\t\t\t\t\t6 Months\r\n\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t</og-optin-button>\r\n\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n            </og-optin-button>            \r\n        </div>\r\n\t\t<div>\r\n            <og-optout-button class="og-onetime">\r\n                One-Time Purchase\r\n            </og-optout-button>            <og-price regular></og-price>\r\n        </div>\r\n    </div>\r\n</og-when>\r\n<og-when test="upsellEligible">\r\n    <og-when test="!upcomingOrderContainsProduct">\r\n        Add to upcoming subscription order and receive 20% off\r\n        <og-upsell-button>\r\n            <button type="button">\r\n                Add to Next Order on \r\n                <og-next-upcoming-order format="{{month-short}} {{day}}, {{year-numeric}}">\r\n                    </og-nextupcoming-order>\r\n            </button>\r\n        </og-upsell-button>\r\n\r\n        <og-upsell-modal>\r\n            Subscribe to this product and have it conveniently delivered to you at the frequency you choose. Promotion subject to change.\r\n            <br />\r\n            <og-when test="subscriptionEligible">\r\n              <og-optout-button>\r\n                  Get one-time\r\n              </og-optout-button>\r\n              <br />\r\n              <og-optin-button>\r\n                  Subscribe and get 10% off on every order\r\n              </og-optin-button>\r\n              Deliver Every: \r\n              <og-select-frequency default-text="(Most Popular)">\r\n                <option value="1_3" >\r\n                  1 month\r\n                </option>\r\n                <option value="2_3" >\r\n                  2 months\r\n                </option>\r\n                <option value="3_3" >\r\n                  3 months\r\n                </option>\r\n                <option value="4_3" >\r\n                  4 months\r\n                </option>\r\n                <option value="5_3" >\r\n                  5 months\r\n                </option>\r\n                <option value="6_3" >\r\n                  6 months\r\n                </option>\r\n              </og-select-frequency>\r\n            </og-when>\r\n            <og-when test="!subscriptionEligible">\r\n              <og-next-upcoming-order format="{{month-short}} {{day}}, {{year-numeric}}">              \r\n            </og-when>\r\n            <br />\r\n            <span slot="confirm">\r\n                <button type="button">Add</button>\r\n            </span>\r\n            <span slot="cancel">\r\n                <button type="button">Cancel</button>\r\n            </span>\r\n        </og-upsell-modal>\r\n    </og-when>\r\n\r\n    <og-when test="upcomingOrderContainsProduct">\r\n       <og-next-upcoming-order format="{{month-short}} {{day}}, {{year-numeric}}">\r\n        </og-nextupcoming-order>\r\n    </og-when>\r\n</og-when>',selector:'[location="pdp"]'},{id:"d0c41f12",markup:'<og-when test="regularEligible">\n    <div class="og-regular-offer-content">\n        <div>\n            <og-optout-button>\n                Deliver one-time only\n            </og-optout-button>            <og-price regular></og-price>\n        </div>\n        <div>\n            <og-optin-button>\n                Make It a Routine\n            </og-optin-button>            <og-price regular class="italic line-through"></og-price>\n            <og-price subscription></og-price>\n            \n            <og-tooltip placement="bottom" >\n                <span slot="trigger"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"\n    width="20" height="20"\n    viewBox="0 0 32 32"\n    style=" fill: #000000;"\n>\n    <path d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M16,21h-2v-7h2V21z M15,11.5 c-0.828,0-1.5-0.672-1.5-1.5s0.672-1.5,1.5-1.5s1.5,0.672,1.5,1.5S15.828,11.5,15,11.5z"></path>\n</svg></span>\n                <span slot="content">Subscribe to this product and have it conveniently delivered to you at the frequency you choose! Promotion subject to change.</span>\n            </og-tooltip>\n        </div>\n    </div>\n    <div style="margin-left: 2.2em">\n        <div class="og-offer-incentive">\n        \t<svg\n        \theight="1em"\n        \twidth="1em"\n        \tviewBox="0 0 24 24"\n        \tfill="none"\n        \txmlns="http://www.w3.org/2000/svg"\n        \t>\n        \t<path\n        \t\td="M20,8 C18.5343681,5.03213345 15.4860999,3 11.9637942,3 C7.01333514,3 3,7.02954545 3,12 M4,16 C5.4656319,18.9678666 8.51390007,21 12.0362058,21 C16.9866649,21 21,16.9704545 21,12 M9,16 L3,16 L3,22 M21,2 L21,8 L15,8"\n        \t\tstroke="currentColor"\n        \t\tstroke-width="2"\n        \t></path>\n        \t</svg>\n        \tGet <og-incentive-text from="DiscountPercent"></og-incentive-text> off today and all future orders.\n        </div>        <og-text key="offerEveryLabel">\n            Deliver Every\n        </og-text>\n        <og-select-frequency default-text="(Recommended)">\n          <option value="1_3" >\n            1 month\n          </option>\n          <option value="2_3" >\n            2 months\n          </option>\n          <option value="3_3" selected="selected"\n            >\n            3 months\n          </option>\n          <option value="4_3" >\n            4 months\n          </option>\n          <option value="5_3" >\n            5 months\n          </option>\n          <option value="6_3" >\n            6 months\n          </option>\n        </og-select-frequency>\n    </div>\n</og-when>\n<og-when test="upsellEligible">\n    <og-when test="!upcomingOrderContainsProduct">\n        Add to upcoming subscription order and receive 20% off\n        <og-upsell-button>\n            <button type="button">\n                Add to Next Order on \n                <og-next-upcoming-order format="{{month-short}} {{day}}, {{year-numeric}}">\n                    </og-nextupcoming-order>\n            </button>\n        </og-upsell-button>\n\n        <og-upsell-modal>\n            Subscribe to this product and have it conveniently delivered to you at the frequency you choose! Read the FAQ here. Promotion subject to change.\n            <br />\n            <og-when test="subscriptionEligible">\n              <og-optout-button>\n                  Get one-time\n              </og-optout-button>\n              <br />\n              <og-optin-button>\n                  Subscribe and get 10% off on every order\n              </og-optin-button>\n              Deliver Every\n              <og-select-frequency default-text="(Recommended)">\n                <option value="1_3" >\n                  1 month\n                </option>\n                <option value="2_3" >\n                  2 months\n                </option>\n                <option value="3_3" selected="selected"\n                  >\n                  3 months\n                </option>\n                <option value="4_3" >\n                  4 months\n                </option>\n                <option value="5_3" >\n                  5 months\n                </option>\n                <option value="6_3" >\n                  6 months\n                </option>\n              </og-select-frequency>\n            </og-when>\n            <og-when test="!subscriptionEligible">\n              <og-next-upcoming-order format="{{month-short}} {{day}}, {{year-numeric}}">              \n            </og-when>\n            <br />\n            <span slot="confirm">\n                <button type="button">Add</button>\n            </span>\n            <span slot="cancel">\n                <button type="button"></button>\n            </span>\n        </og-upsell-modal>\n    </og-when>\n\n    <og-when test="upcomingOrderContainsProduct">\n       <og-next-upcoming-order format="{{month-short}} {{day}}, {{year-numeric}}">\n        </og-nextupcoming-order>\n    </og-when>\n</og-when>',selector:"og-offer"}]).setPublicPath("//static.ordergroove.com/@ordergroove/offers/2.46.0/dist/"),function(n){const t=n.createElement("style");t.type="text/css",t.appendChild(n.createTextNode('[location="cart"] {\n  --og-radio-width: 22px;\n  --og-radio-height: 22px;\n  --og-radio-margin: 0 5px 0 0;\n  --og-select-padding: 0.4em 2.8em 0.4em 0.5em;\n  --og-select-bg-color: transparent;\n  --og-select-border: 1px solid #090909;\n  --og-select-font-size: 12px;\n  --og-tooltip-family: Roboto, Helvetica, sans-serif;\n  --og-tooltip-size: 12px;\n  --og-tooltip-color: #fff;\n  --og-tooltip-background: #090909;\n  --og-tooltip-border: 1px solid #cdcdcd;\n  --og-tooltip-border-radius: 5px;\n  --og-tooltip-padding: 1em;\n  --og-tooltip-text-align: center;\n  --og-tooltip-placement: bottom;\n  --og-tooltip-box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);\n  --og-wrapper-min-width: 23em;\n}\n\n@media only screen and (max-width: 600px) {\n  [location="cart"] {\n    --og-wrapper-min-width: 0;\n  }\n}\n\n[location="cart"] og-offer {\n  --og-primary-color: var(--og-tooltip-background, rgb(70, 124, 141));\n  --og-default-color: #ccc;\n  --og-lead-font-size: 1.3em;\n}\n\n[location="cart"] og-optin-toggle {\n  font-family: Roboto, Helvetica, sans-serif;\n  font-size: 16px;\n  font-weight: 700;\n  margin-top: 1em;\n  font-weight: 700;\n}\n\n[location="cart"] .og-offer-incentive {\n  font-size: var(--og-secondary-font-size, 12px);\n}\n\n[location="cart"] og-text[key=\'offerEveryLabel\'] {\n  font-weight: 700;\n  font-family: var(--og-global-family, Roboto, sans-serif);\n  color: var(--og-global-color, #090909);\n  font-size: var(--og-select-font-size, 12px);\n  margin: 1em 0 0.3em;\n  display: block;\n}\n\n[location="cart"] og-select-frequency {\n  border-radius: 0;\n}\n\n[location="cart"] og-price[regular] {\n  font-size: 14px;\n  opacity: 67.5%;\n}\n\n[location="cart"] og-price[subscription] {\n  color: var(--og-global-color, #090909);\n  font-weight: 700;\n}\n\n[location="cart"] .italic {\n  font-style: italic;\n}\n\n[location="cart"] .line-through {\n  text-decoration: line-through;\n}\n\n[location="cart"] svg,\n[location="cart"] button {\n  vertical-align: text-bottom;\n  outline: none;\n}\n\n[location="cart"] .og-regular-offer-content {\n  display: flex;\n  gap: 1.5em;\n}\n\n[location="cart"] .og-select-frequency,\n[location="cart"] .og-optin-button-item {\n  margin: 0 0 1.5em;\n}\n\n[location="cart"] .og-button-toggle {\n  border: 2px solid var(--og-checkbox-border-color, var(--og-primary-color, inherit));\n  padding: 2px;\n  line-height: 11px;\n  border-radius: 3px;\n  margin: 0 5px 0 0;\n  background: #fff;\n}\n\n[location="cart"] og-optin-toggle > div {\n  display: flex;\n  align-items: center;\n  gap: 5px;\n}\n\n[location="cart"] og-price[regular] {\n  margin-left: 12px;\n  margin-right: 6px;\n}\n\n[location="cart"] og-optin-toggle + div {\n  height: 0;\n  margin: 10px 0 10px 30px;\n  overflow: hidden;\n  transition: height 0.2s ease;\n  font-family: var(--og-global-family, Roboto, sans-serif);\n}\n\n[location="cart"] og-optin-toggle[subscribed] + div {\n  min-height: 50px;\n  height: auto;\n}\n\n[location="cart"] [subscribed] .og-button-toggle {\n  background: var(--og-checkbox-border-color, var(--og-primary-color, inherit));\n}\n\n[location="cart"] .og-button-toggle svg {\n  visibility: hidden;\n  fill: #fff;\n}\n\n[location="cart"] [subscribed] .og-button-toggle svg {\n  visibility: visible;\n}\n\n[location="cart"] {\n--og-global-family: inherit;\n--og-global-size: inherit;\n--og-global-color: inherit;\n--og-wrapper-padding: 10px 0;\n--og-checkbox-border-color: #000000;\n--og-tooltip-family: Arial, Helvetica, sans-serif;\n--og-tooltip-size: 13px;\n--og-tooltip-color: #298266;\n--og-upsell-color: #c3e7c3;\n--og-upsell-family: Arial, Helvetica, sans-serif;\n--og-upsell-size: 13px;\n--og-upsell-color: #298266;\n--og-tooltip-background: rgba(255,255,255,1);\n--og-tooltip-placement: bottom;\n--og-tooltip-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);\n}\n[location="category"] {\n  --og-radio-width: 22px;\n  --og-radio-height: 22px;\n  --og-radio-margin: 0 5px 0 0;\n  --og-select-padding: 0.4em 2.8em 0.4em 0.5em;\n  --og-select-bg-color: transparent;\n  --og-select-border: 1px solid #090909;\n  --og-select-font-size: 12px;\n  --og-tooltip-family: Roboto, Helvetica, sans-serif;\n  --og-tooltip-size: 12px;\n  --og-tooltip-color: #090909;\n  --og-tooltip-background: #ffffff;\n  --og-tooltip-border: 1px solid #cdcdcd;\n  --og-tooltip-border-radius: 5px;\n  --og-tooltip-padding: 1em;\n  --og-tooltip-text-align: center;\n  --og-tooltip-placement: bottom;\n  --og-tooltip-box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);\n}\n\n[location="category"] og-optout-button,\n[location="category"] og-optin-button {\n  font-family: Roboto, Helvetica, sans-serif;\n  font-size: 16px;\n}\n\n[location="category"] og-optin-button {\n  font-weight: 700;\n}\n\n[location="category"] og-optin-button .btn,\n[location="category"] og-optin-button button {\n  transform: scale(2);\n}\n\n[location="category"] og-tooltip {\n  vertical-align: middle;\n}\n\n[location="category"] .og-offer-incentive {\n  font-size: var(--og-secondary-font-size, 12px);\n}\n\n[location="category"] .og-offer-incentive svg {\n  transform: translateY(0.125em);\n}\n\n[location="category"] og-text[key=\'offerEveryLabel\'] {\n  font-weight: 700;\n  font-family: var(--og-global-family, Roboto, sans-serif);\n  color: var(--og-global-color, #090909);\n  font-size: var(--og-select-font-size, 12px);\n  margin: 1em 0 0.3em;\n  display: block;\n}\n\n[location="category"] og-optin-button {\n  font-weight: 700;\n}\n\n[location="category"] og-select-frequency {\n  border-radius: 0;\n}\n\n[location="category"] og-price {\n  display: inline-flex;\n}\n\n[location="category"] og-price[regular] {\n  font-size: 14px;\n  opacity: 67.5%;\n}\n\n[location="category"] og-price[subscription] {\n  color: var(--og-global-color, #090909);\n  font-weight: 700;\n}\n\n[location="category"] .italic {\n  font-style: italic;\n}\n\n[location="category"] .line-through {\n  text-decoration: line-through;\n}\n\n[location="category"] .og-regular-offer-content {\n  display: flex;\n  flex-direction: column;\n  gap: 1em;\n}\n\n[location="category"] .og-regular-offer-content > div {\n  line-height: 1em;\n}\n\n[location="category"] {\n--og-global-family: inherit;\n--og-global-size: inherit;\n--og-global-color: inherit;\n--og-wrapper-padding: 10px 0;\n--og-tooltip-family: inherit;\n--og-tooltip-size: inherit;\n--og-tooltip-color: inherit;\n--og-tooltip-background: #fff;\n--og-tooltip-placement: bottom;\n--og-upsell-color: #c3e7c3;\n--og-upsell-family: Arial, Helvetica, sans-serif;\n--og-upsell-size: 13px;\n--og-upsell-color: #298266;\n--og-tooltip-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);\n}\n[location="pdp"] {\r\n  --og-radio-width: 22px;\r\n  --og-radio-height: 22px;\r\n  --og-radio-margin: 0 5px 0 0;\r\n  --og-select-padding: 0.4em 2.8em 0.4em 0.5em;\r\n  --og-select-bg-color: transparent;\r\n  --og-select-border: 1px solid #090909;\r\n  --og-select-font-size: 12px;\r\n  --og-tooltip-family: Roboto, Helvetica, sans-serif;\r\n  --og-tooltip-size: 12px;\r\n  --og-tooltip-color: #090909;\r\n  --og-tooltip-background: #ffffff;\r\n  --og-tooltip-border: 1px solid #cdcdcd;\r\n  --og-tooltip-border-radius: 5px;\r\n  --og-tooltip-padding: 1em;\r\n  --og-tooltip-text-align: center;\r\n  --og-tooltip-placement: bottom;\r\n  --og-tooltip-box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);\r\n}\r\n\r\n[location="pdp"] og-optin-button .btn,\r\n[location="pdp"] og-optin-button button {\r\n  transform: scale(2);\r\n}\r\n\r\n[location="pdp"] og-tooltip {\r\n  vertical-align: middle;\r\n}\r\n\r\n[location="pdp"] .og-optin-buttons {\r\n  display: grid;\r\n  gap: 16px;\r\n  grid-template-columns: repeat(3, 62px);\r\n  overflow: hidden;\r\n}\r\n\r\n[location="pdp"] .og-subscription-option {\r\n  text-align: center;\r\n  font-variant-numeric: lining-nums proportional-nums;\r\n  font-family: Raleway;\r\n  font-size: 14px;\r\n  font-style: normal;\r\n  font-weight: 500;\r\n  line-height: 17px;\r\n}\r\n\r\n[location="pdp"] og-optin-button[subscribed][frequency-match].og-subscription-option {\r\n  font-weight: 700;\r\n  border-bottom: 1px solid #000;\r\n}\r\n\r\n[location="pdp"] .og-subscription {\r\n  padding: 16px;\r\n  border: 1px solid #E1DED9;\r\n  width: 100%;\r\n  background: transparent;\r\n  font-family: \'Raleway\';\r\n  font-size: 16px;\r\n  font-style: normal;\r\n  font-weight: 600;\r\n  line-height:24px;\r\n}\r\n\r\n[location="pdp"] .og-onetime {\r\n  border: 2px solid #000000;\r\n  width: 100%;\r\n  padding: 16px;\r\n  background: #F8F8F8;\r\n  font-size: 16px;\r\n  font-family: \'Raleway\';\r\n  font-weight: 600;\r\n  line-height: 24px;\r\n  font-style: normal;\r\n}\r\n\r\n[location="pdp"] og-optout-button[subscribed].og-onetime {\r\n  border: 1px solid #E1DED9;\r\n  background: transparent;\r\n}\r\n\r\n[location="pdp"] og-optin-button[subscribed].og-subscription {\r\n  border: 2px solid #000000;\r\n  background: #F8F8F8;\r\n}\r\n\r\n[location="pdp"] .og-offer-incentive {\r\n  font-size: 14px;\r\n  padding-top: 4px;\r\n  font-weight: 400;\r\n  line-height: 21px;\r\n  padding-bottom: 24px;\r\n  font-family: \'Raleway\';\r\n}\r\n\r\n[location="pdp"] .og-offer-incentive svg {\r\n  transform: translateY(0.125em);\r\n}\r\n\r\n[location="pdp"] og-text[key=\'offerEveryLabel\'] {\r\n  font-weight: 700;\r\n  font-family: var(--og-global-family, Roboto, sans-serif);\r\n  color: var(--og-global-color, #090909);\r\n  font-size: var(--og-select-font-size, 12px);\r\n  margin: 1em 0 0.3em;\r\n  display: block;\r\n}\r\n\r\n[location="pdp"] og-select-frequency {\r\n  border-radius: 0;\r\n  font-family: \'Raleway\';\r\n  font-size: 14px;\r\n  font-weight:700;\r\n  line-height: 17px;\r\n}\r\n\r\n[location="pdp"] og-price {\r\n  display: inline-flex;\r\n}\r\n\r\n[location="pdp"] og-price[regular] {\r\n  font-size: 14px;\r\n  opacity: 67.5%;\r\n}\r\n\r\n[location="pdp"] og-price[subscription] {\r\n  color: var(--og-global-color, #090909);\r\n  font-weight: 700;\r\n}\r\n\r\n[location="pdp"] .italic {\r\n  font-style: italic;\r\n}\r\n\r\n[location="pdp"] .line-through {\r\n  text-decoration: line-through;\r\n}\r\n\r\n[location="pdp"] .og-regular-offer-content {\r\n  display: flex;\r\n  flex-direction: column;\r\n  gap: 1em;\r\n}\r\n\r\n[location="pdp"] .og-regular-offer-content > div {\r\n  line-height: 1em;\r\n}\r\n\r\n[location="pdp"] {\r\n--og-global-family: \'Raleway\';\r\n--og-global-size: 16px;\r\n--og-global-color: #333;\r\n--og-wrapper-padding: 10px 0;\r\n--og-tooltip-family: Arial, Helvetica, sans-serif;\r\n--og-tooltip-size: 13px;\r\n--og-tooltip-color: #000;\r\n--og-tooltip-background: #fff;\r\n--og-tooltip-placement: bottom;\r\n--og-upsell-color: #c3e7c3;\r\n--og-upsell-family: Arial, Helvetica, sans-serif;\r\n--og-upsell-size: 13px;\r\n--og-upsell-color: #298266;\r\n}\nog-offer {\n  --og-radio-width: 22px;\n  --og-radio-height: 22px;\n  --og-radio-margin: 0 5px 0 0;\n  --og-select-padding: 0.4em 2.8em 0.4em 0.5em;\n  --og-select-bg-color: transparent;\n  --og-select-border: 1px solid #090909;\n  --og-select-font-size: 12px;\n  --og-tooltip-family: Roboto, Helvetica, sans-serif;\n  --og-tooltip-size: 12px;\n  --og-tooltip-color: #090909;\n  --og-tooltip-background: #ffffff;\n  --og-tooltip-border: 1px solid #cdcdcd;\n  --og-tooltip-border-radius: 5px;\n  --og-tooltip-padding: 1em;\n  --og-tooltip-text-align: center;\n  --og-tooltip-placement: bottom;\n  --og-tooltip-box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);\n}\n\nog-offer og-optout-button,\nog-offer og-optin-button {\n  font-family: Roboto, Helvetica, sans-serif;\n  font-size: 16px;\n}\n\nog-offer og-optin-button {\n  font-weight: 700;\n}\n\nog-offer og-optin-button .btn,\nog-offer og-optin-button button {\n  transform: scale(2);\n}\n\nog-offer og-tooltip {\n  vertical-align: middle;\n}\n\nog-offer .og-offer-incentive {\n  font-size: var(--og-secondary-font-size, 12px);\n}\n\nog-offer .og-offer-incentive svg {\n  transform: translateY(0.125em);\n}\n\nog-offer og-text[key=\'offerEveryLabel\'] {\n  font-weight: 700;\n  font-family: var(--og-global-family, Roboto, sans-serif);\n  color: var(--og-global-color, #090909);\n  font-size: var(--og-select-font-size, 12px);\n  margin: 1em 0 0.3em;\n  display: block;\n}\n\nog-offer og-optin-button {\n  font-weight: 700;\n}\n\nog-offer og-select-frequency {\n  border-radius: 0;\n}\n\nog-offer og-price {\n  display: inline-flex;\n}\n\nog-offer og-price[regular] {\n  font-size: 14px;\n  opacity: 67.5%;\n}\n\nog-offer og-price[subscription] {\n  color: var(--og-global-color, #090909);\n  font-weight: 700;\n}\n\nog-offer .italic {\n  font-style: italic;\n}\n\nog-offer .line-through {\n  text-decoration: line-through;\n}\n\nog-offer .og-regular-offer-content {\n  display: flex;\n  flex-direction: column;\n  gap: 1em;\n}\n\nog-offer .og-regular-offer-content > div {\n  line-height: 1em;\n}\n\nog-offer {\n--og-global-family: inherit;\n--og-global-size: inherit;\n--og-global-color: inherit;\n--og-wrapper-padding: 10px 0;\n--og-tooltip-family: inherit;\n--og-tooltip-size: inherit;\n--og-tooltip-color: inherit;\n--og-tooltip-background: rgba(255,255,255,1);\n--og-tooltip-placement: bottom;\n--og-tooltip-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);\n--og-upsell-family: Arial, Helvetica, sans-serif;\n--og-upsell-size: 13px;\n--og-upsell-color: rgba(99,119,219,1);\n}')),n.head.appendChild(t)}(document),(window.location.hash.includes("og_quick_action=")||window.location.search.includes("og_quick_action="))&&function(n){const t=n.createElement("script");t.type="text/javascript",t.src="//static.ordergroove.com/d9e0963334254858b90cf68389c2aace/oca.js?",n.head.appendChild(t)}(document);return module.exports;});
//# sourceMappingURL=offers.js.map?v=2.46.0