function Convert(keyCode)
{
    //why don't i do all the keys this way? couse the wasd is not used for movement in every keyboard langue so i do those 4 based on the layout not the actual keys
    let key = null;
    switch (keyCode)
    {
        case 37:
            key = 'KeyLeftArrow';
            break;
        case 39:
            key = 'KeyRightArrow';
            break;
        case 38:
            key = 'KeyUpArrow';
            break;
        case 40:
            key = 'KeyDownArrow';
            break;
        case 13:
            key = 'KeyEnter';
            break;
        case 32:
            key = 'KeySpace';
            break;
        case 46:
            key = 'KeyDelete'
            break;
        case 8:
            key = 'KeyBackSpace'
            break;
        case 27:
            key = 'KeyEscape'
            break;
    }
    return key;
}
window.Convert = Convert;
