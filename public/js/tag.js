let inputNewTags = document.getElementById('tag');
let buttonAddTags = document.getElementById('buttonAddTags');
let listTags = document.getElementById('listTags');
let tagsInputHidden = document.getElementById('hiddenTags');
let hiddenTagsToDelete = document.getElementById('hiddenTagsToDelete');
let valueInputHidden = [];
let valueInputHiddenToDelete = [];

buttonAddTags.addEventListener('click' , function(e){
    if(inputNewTags.value.length > 0){
        //On met la valeur du input dans le champ input
        valueInputHidden.push(inputNewTags.value);
        tagsInputHidden.value = valueInputHidden;
        //On créé le visu du tag
        let divNewTag = document.createElement('div');
        divNewTag.setAttribute('class' , 'row rounded bg-primary mr-4');
        listTags.appendChild(divNewTag);
        let choiceP = document.createElement('p');
        choiceP.setAttribute('class' , 'text-light text-center mb-1 px-2');
        choiceP.setAttribute('state' , 'add');
        choiceP.textContent = inputNewTags.value;
        divNewTag.appendChild(choiceP);
        let choiceSpanDelete = document.createElement('button');
        choiceSpanDelete.setAttribute('class' , 'rounded border border-danger bg-danger text-center text-light');
        choiceSpanDelete.setAttribute('onclick' , 'changeStateTags(event)');
        choiceSpanDelete.textContent = 'x';
        divNewTag.appendChild(choiceSpanDelete);
        //On remet la valeur du champ vide
        inputNewTags.value="";
    }
});

function changeStateTags(event){
    if(event.target.parentNode.children[0].getAttribute('state') == 'here'){
            valueInputHiddenToDelete.push(event.target.parentNode.children[0].textContent);
            hiddenTagsToDelete.value=valueInputHiddenToDelete;
            myNode = event.target.parentNode.parentNode;
            myNode.removeChild(event.target.parentNode);
        }else if(event.target.parentNode.children[0].getAttribute('state') == 'add'){
            let tagsInput = valueInputHidden.filter(word=>word != event.target.parentNode.children[0].textContent);
            valueInputHidden = tagsInput;
            tagsInputHidden.value = valueInputHidden;
            myNode = event.target.parentNode.parentNode;
            myNode.removeChild(event.target.parentNode);
        }
    event.preventDefault();
}
