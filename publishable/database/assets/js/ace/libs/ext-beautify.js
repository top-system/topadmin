ace.define("ace/ext/beautify",["require","exports","module","ace/token_iterator"],(function(e,t,r){"use strict";var a=e("../token_iterator").TokenIterator;function o(e,t){return e.type.lastIndexOf(t+".xml")>-1}t.singletonTags=["area","base","br","col","command","embed","hr","html","img","input","keygen","link","meta","param","source","track","wbr"],t.blockTags=["article","aside","blockquote","body","div","dl","fieldset","footer","form","head","header","html","nav","ol","p","script","section","style","table","tbody","tfoot","thead","ul"],t.beautify=function(e){for(var r,s,n,i=new a(e,0,0),c=i.getCurrentToken(),u=e.getTabString(),l=t.singletonTags,m=t.blockTags,p=!1,f=!1,h=!1,y="",b="",d="",g=0,$=0,k=0,x=0,w=0,v=0,T=0,R=0,O=0,q=!1,C=!1,I=!1,_=!1,j={0:0},B=[],F=function(){r&&r.value&&"string.regexp"!==r.type&&(r.value=r.value.replace(/^\s*/,""))},S=function(){y=y.replace(/ +$/,"")},K=function(){y=y.trimRight(),p=!1};null!==c;){if(R=i.getCurrentTokenRow(),i.$rowTokens,r=i.stepForward(),void 0!==c){if(b=c.value,w=0,I="style"===d||"ace/mode/css"===e.$modeId,o(c,"tag-open")?(C=!0,r&&(_=-1!==m.indexOf(r.value)),"</"===b&&(_&&!p&&O<1&&O++,I&&(O=1),w=1,_=!1)):o(c,"tag-close")?C=!1:o(c,"comment.start")?_=!0:o(c,"comment.end")&&(_=!1),C||O||"paren.rparen"!==c.type||"}"!==c.value.substr(0,1)||O++,R!==s&&(O=R,s&&(O-=s)),O){for(K();O>0;O--)y+="\n";p=!0,o(c,"comment")||c.type.match(/^(comment|string)$/)||(b=b.trimLeft())}if(b){if("keyword"===c.type&&b.match(/^(if|else|elseif|for|foreach|while|switch)$/)?(B[g]=b,F(),h=!0,b.match(/^(else|elseif)$/)&&y.match(/\}[\s]*$/)&&(K(),f=!0)):"paren.lparen"===c.type?(F(),"{"===b.substr(-1)&&(h=!0,q=!1,C||(O=1)),"{"===b.substr(0,1)&&(f=!0,"["!==y.substr(-1)&&"["===y.trimRight().substr(-1)?(K(),f=!1):")"===y.trimRight().substr(-1)?K():S())):"paren.rparen"===c.type?(w=1,"}"===b.substr(0,1)&&("case"===B[g-1]&&w++,"{"===y.trimRight().substr(-1)?K():(f=!0,I&&(O+=2))),"]"===b.substr(0,1)&&"}"!==y.substr(-1)&&"}"===y.trimRight().substr(-1)&&(f=!1,x++,K()),")"===b.substr(0,1)&&"("!==y.substr(-1)&&"("===y.trimRight().substr(-1)&&(f=!1,x++,K()),S()):"keyword.operator"!==c.type&&"keyword"!==c.type||!b.match(/^(=|==|===|!=|!==|&&|\|\||and|or|xor|\+=|.=|>|>=|<|<=|=>)$/)?"punctuation.operator"===c.type&&";"===b?(K(),F(),h=!0,I&&O++):"punctuation.operator"===c.type&&b.match(/^(:|,)$/)?(K(),F(),b.match(/^(,)$/)&&T>0&&0===v?O++:(h=!0,p=!1)):"support.php_tag"!==c.type||"?>"!==b||p?o(c,"attribute-name")&&y.substr(-1).match(/^\s$/)?f=!0:o(c,"attribute-equals")?(S(),F()):o(c,"tag-close")&&(S(),"/>"===b&&(f=!0)):(K(),f=!0):(K(),F(),f=!0,h=!0),p&&(!c.type.match(/^(comment)$/)||b.substr(0,1).match(/^[/#]$/))&&(!c.type.match(/^(string)$/)||b.substr(0,1).match(/^['"]$/))){if(x=k,g>$)for(x++,n=g;n>$;n--)j[n]=x;else g<$&&(x=j[g]);for($=g,k=x,w&&(x-=w),q&&!v&&(x++,q=!1),n=0;n<x;n++)y+=u}if("keyword"===c.type&&b.match(/^(case|default)$/)&&(B[g]=b,g++),"keyword"===c.type&&b.match(/^(break)$/)&&B[g-1]&&B[g-1].match(/^(case|default)$/)&&g--,"paren.lparen"===c.type&&(v+=(b.match(/\(/g)||[]).length,T+=(b.match(/\{/g)||[]).length,g+=b.length),"keyword"===c.type&&b.match(/^(if|else|elseif|for|while)$/)?(q=!0,v=0):!v&&b.trim()&&"comment"!==c.type&&(q=!1),"paren.rparen"===c.type)for(v-=(b.match(/\)/g)||[]).length,T-=(b.match(/\}/g)||[]).length,n=0;n<b.length;n++)g--,"}"===b.substr(n,1)&&"case"===B[g]&&g--;"text"==c.type&&(b=b.replace(/\s+$/," ")),f&&!p&&(S(),"\n"!==y.substr(-1)&&(y+=" ")),y+=b,h&&(y+=" "),p=!1,f=!1,h=!1,(o(c,"tag-close")&&(_||-1!==m.indexOf(d))||o(c,"doctype")&&">"===b)&&(O=_&&r&&"</"===r.value?-1:1),o(c,"tag-open")&&"</"===b?g--:o(c,"tag-open")&&"<"===b&&-1===l.indexOf(r.value)?g++:o(c,"tag-name")?d=b:o(c,"tag-close")&&"/>"===b&&-1===l.indexOf(d)&&g--,s=R}}c=r}y=y.trim(),e.doc.setValue(y)},t.commands=[{name:"beautify",description:"Format selection (Beautify)",exec:function(e){t.beautify(e.session)},bindKey:"Ctrl-Shift-B"}]})),ace.require(["ace/ext/beautify"],(function(e){"object"==typeof module&&"object"==typeof exports&&module&&(module.exports=e)}));
