import axios from 'axios';

export function fetchToken(){
    const tokenUrl = '/api/login';
    const email = 'topceo200@gmail.com';
    const password = '123123123';

    const postData = {
        email,
        password
    }

    return axios.post(tokenUrl,postData);
}