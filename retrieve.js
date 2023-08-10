
            function A(a, b) {
                let x = document.getElementById(a).value;
                document.execCommand(b, false, x);
                f();
            }

            function B(a) {
                document.execCommand(a, false, null);
                f();
            }

            document.getElementById("back").onclick = function () {
                window.open("index.php","_blank");
            };
            
            document.getElementById("new").onclick = function () {
                window.open("dashboard.php","_blank");
            };
           
            var editor = document.getElementById("div");

            function S(){
                document.getElementById('hidden').value = document.getElementById('div').innerHTML;
                document.getElementById('hidden2').value = document.getElementById('title').innerHTML;
                document.getElementById('hidden4').value = document.getElementById('font-select').selectedIndex;
                document.getElementById('hidden5').value = document.getElementById('size-select').selectedIndex;
            }

          //Adding List
            function formatDoc(sCmd) {
                document.execCommand(sCmd, false, null);
                editor.focus();
                f();
            };

            //to make sure that pressing tab does not take us out of the contenteditalbe div
            function onKeyDown(e) {
                if (e.keyCode === 9) { // tab key
                    e.preventDefault();  // this will prevent us from tabbing out of the editor

                    // now insert four non-breaking spaces for the tab key
                    var editor = document.getElementById("div");
                    var doc = editor.ownerDocument.defaultView;
                    var sel = doc.getSelection();
                    var range = sel.getRangeAt(0);

                    var tabNode = document.createTextNode("\u00a0\u00a0\u00a0\u00a0");
                    range.insertNode(tabNode);

                    range.setStartAfter(tabNode);
                    range.setEndAfter(tabNode); 
                    sel.removeAllRanges();
                    sel.addRange(range);
                }
            }
            
            //To set the cursor back to the original position
            function f(){
                const el = document.getElementById('div');  
                const selection = window.getSelection();  
                const range = document.createRange();  
                range.selectNodeContents(el);  
                range.collapse(false);  
                selection.addRange(range);  
                el.focus();
            }

            //to color the buttons 
            setInterval(() => {
                    var isBold = document.queryCommandValue("Bold");
                    var isItalic = document.queryCommandValue("Italic");
                    var isUnderline = document.queryCommandValue("Underline");
                    
                    if (isBold === 'true') {
                         document.getElementById('b').style.backgroundColor = 'red';
                    } else {                   
                        document.getElementById('b').style.backgroundColor = 'white';
                    }
                    
                    if (isItalic === 'true') {
                         document.getElementById('i').style.backgroundColor = 'red';
                    } else {                   
                        document.getElementById('i').style.backgroundColor = 'white';
                    }

                    if (isUnderline === 'true') {
                         document.getElementById('u').style.backgroundColor = 'red';
                    } else {                   
                        document.getElementById('u').style.backgroundColor = 'white';
                    }
                }, 100);    
            
            // to change the font family
            function font(){
                let x =  document.getElementById("font-select").value;
                document.getElementById("div").style.fontFamily = x;
            }

            // to change the font size
            function abc(){
                let aa = document.getElementById("size-select").value;
                editor.style.fontSize = aa;
            }

             //enable resize
             function enableImageResizeInDiv(id) {
                if (!(/chrome/i.test(navigator.userAgent) && /google/i.test(window.navigator.vendor))) {
                    return;
                }
                var editor = document.getElementById(id);
                var resizing = false;
                var currentImage;
                var createDOM = function (elementType, className, styles) {
                    let ele = document.createElement(elementType);
                    ele.className = className;
                    setStyle(ele, styles);
                    return ele;
                };
                var setStyle = function (ele, styles) {
                    for (key in styles) {
                        ele.style[key] = styles[key];
                    }
                    return ele;
                };
                var removeResizeFrame = function () {
                    document.querySelectorAll(".resize-frame,.resizer").forEach((item) => item.parentNode.removeChild(item));
                };
                var offset = function offset(el) {
                    const rect = el.getBoundingClientRect(),
                    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
                    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
                };
                var clickImage = function (img) {
                    removeResizeFrame();
                    currentImage = img;
                    const imgHeight = img.offsetHeight;
                    const imgWidth = img.offsetWidth;
                    const imgPosition = { top: img.offsetTop, left: img.offsetLeft };
                    const editorScrollTop = editor.scrollTop;
                    const editorScrollLeft = editor.scrollLeft;
                    const top = imgPosition.top - editorScrollTop - 1;
                    const left = imgPosition.left - editorScrollLeft - 1;
        
                    editor.append(createDOM('span', 'resize-frame', {
                        margin: '10px',
                        position: 'absolute',
                        top: (top + imgHeight - 10) + 'px',
                        left: (left + imgWidth - 10) + 'px',
                        border: 'solid 3px blue',
                        width: '6px',
                        height: '6px',
                        cursor: 'se-resize',
                        zIndex: 1
                    }));
        
                    editor.append(createDOM('span', 'resizer top-border', {
                        position: 'absolute',
                        top: (top) + 'px',
                        left: (left) + 'px',
                        border: 'dashed 1px grey',
                        width: imgWidth + 'px',
                        height: '0px'
                    }));
        
                    editor.append(createDOM('span', 'resizer left-border', {
                        position: 'absolute',
                        top: (top) + 'px',
                        left: (left) + 'px',
                        border: 'dashed 1px grey',
                        width: '0px',
                        height: imgHeight + 'px'
                    }));
        
                    editor.append(createDOM('span', 'resizer right-border', {
                        position: 'absolute',
                        top: (top) + 'px',
                        left: (left + imgWidth) + 'px',
                        border: 'dashed 1px grey',
                        width: '0px',
                        height: imgHeight + 'px'
                    }));
        
                    editor.append(createDOM('span', 'resizer bottom-border', {
                        position: 'absolute',
                        top: (top + imgHeight) + 'px',
                        left: (left) + 'px',
                        border: 'dashed 1px grey',
                        width: imgWidth + 'px',
                        height: '0px'
                    }));
        
                    document.querySelector('.resize-frame').onmousedown = () => {
                        resizing = true;
                        return false;
                    };
        
                    editor.onmouseup = () => {
                        if (resizing) {
                            currentImage.style.width = document.querySelector('.top-border').offsetWidth + 'px';
                            currentImage.style.height = document.querySelector('.left-border').offsetHeight + 'px';
                            refresh();
                            currentImage.click();
                            resizing = false;
                        }
                    };
        
                    editor.onmousemove = (e) => {
                        if (currentImage && resizing) {
                            let height = e.pageY - offset(currentImage).top;
                            let width = e.pageX - offset(currentImage).left;
                            height = height < 1 ? 1 : height;
                            width = width < 1 ? 1 : width;
                            const top = imgPosition.top - editorScrollTop - 1;
                            const left = imgPosition.left - editorScrollLeft - 1;
                            setStyle(document.querySelector('.resize-frame'), {
                                top: (top + height - 10) + 'px',
                                left: (left + width - 10) + "px"
                            });
        
                            setStyle(document.querySelector('.top-border'), { width: width + "px" });
                            setStyle(document.querySelector('.left-border'), { height: height + "px" });
                            setStyle(document.querySelector('.right-border'), {
                                left: (left + width) + 'px',
                                height: height + "px"
                            });
                            setStyle(document.querySelector('.bottom-border'), {
                                top: (top + height) + 'px',
                                width: width + "px"
                            });
                        }
                        return false;
                    };
                };
                var bindClickListener = function () {
                    editor.querySelectorAll('img').forEach((img, i) => {
                        img.onclick = (e) => {
                            if (e.target === img) {
                                clickImage(img);
                            }
                        };
                    });
                };
                var refresh = function () {
                    bindClickListener();
                    removeResizeFrame();
                    if (!currentImage) {
                        return;
                    }
                    var img = currentImage;
                    var imgHeight = img.offsetHeight;
                    var imgWidth = img.offsetWidth;
                    var imgPosition = { top: img.offsetTop, left: img.offsetLeft };
                    var editorScrollTop = editor.scrollTop;
                    var editorScrollLeft = editor.scrollLeft;
                    const top = imgPosition.top - editorScrollTop - 1;
                    const left = imgPosition.left - editorScrollLeft - 1;
        
                    editor.append(createDOM('span', 'resize-frame', {
                        position: 'absolute',
                        top: (top + imgHeight) + 'px',
                        left: (left + imgWidth) + 'px',
                        border: 'solid 2px red',
                        width: '6px',
                        height: '6px',
                        cursor: 'se-resize',
                        zIndex: 1
                    }));
        
                    editor.append(createDOM('span', 'resizer', {
                        position: 'absolute',
                        top: (top) + 'px',
                        left: (left) + 'px',
                        border: 'dashed 1px grey',
                        width: imgWidth + 'px',
                        height: '0px'
                    }));
        
                    editor.append(createDOM('span', 'resizer', {
                        position: 'absolute',
                        top: (top) + 'px',
                        left: (left + imgWidth) + 'px',
                        border: 'dashed 1px grey',
                        width: '0px',
                        height: imgHeight + 'px'
                    }));
        
                    editor.append(createDOM('span', 'resizer', {
                        position: 'absolute',
                        top: (top + imgHeight) + 'px',
                        left: (left) + 'px',
                        border: 'dashed 1px grey',
                        width: imgWidth + 'px',
                        height: '0px'
                    }));
                };
                var reset = function () {
                    if (currentImage != null) {
                        currentImage = null;
                        resizing = false;
                        removeResizeFrame();
                    }
                    bindClickListener();
                };
                editor.addEventListener('scroll', function () {
                    reset();
                }, false);
                editor.addEventListener('mouseup', function (e) {
                    if (!resizing) {
                        const x = (e.x) ? e.x : e.clientX;
                        const y = (e.y) ? e.y : e.clientY;
                        let mouseUpElement = document.elementFromPoint(x, y);
                        if (mouseUpElement) {
                            let matchingElement = null;
                            if (mouseUpElement.tagName === 'IMG') {
                                matchingElement = mouseUpElement;
                            }
                            if (!matchingElement) {
                                reset();
                            } else {
                                clickImage(matchingElement);
                            }
                        }
                    }
                });
            }
        enableImageResizeInDiv('div');