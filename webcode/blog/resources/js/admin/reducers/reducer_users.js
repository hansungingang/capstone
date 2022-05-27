import axios from "axios";
import { FETCH_USER, SEARCH_USER, FETCH_ONE_USER,FETCH_USER_UPDATE } from "./types/userType";
import { fetchToken } from "./AuthService";

const userUrl = '/api/allUser';
const oneUserUrl = '/api/oneUser';

export function fetchUserAsync(){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` }
            }
            axios.get(userUrl,config)
            .then((response)=>{
                dispatch(receiveUser(response.data.data))
            })
        })
        .catch((error)=>{
            return null;
        })
    }
}

function receiveUser(data){
    return {
        type: FETCH_USER,
        payload: data
    }
}

const searchUrl = '/api/user/search';
export function searchEmailUserAsync(email){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` },
                params: {
                    email: email
                }
            }
            axios.get(searchUrl,config)
            .then((response)=>{
                dispatch(searchUser(response.data.data))
            })
        })
        .catch((error)=>{
            return null;
        })
    }
}

function searchUser(data){
    return {
        type : SEARCH_USER,
        payload : data
    }
}

const INITIAL_STATE = [];

export const allUserReducer = (state=INITIAL_STATE,action) =>{
    switch(action.type){
        case FETCH_USER:
            return action.payload
        case SEARCH_USER:
            return action.payload
        default:
            return state;
    }
}


export function fetchOneUserAsync(id){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` },
            }
            axios.get(oneUserUrl+'/'+id,config)
            .then((response)=>{
                dispatch(fetchOneUser(response.data.data))
            })
        })
        .catch((error)=>{
            return null;
        })
    }
}

function fetchOneUser(data){
    return {
        type: FETCH_ONE_USER,
        payload: data
    }
}

const OneUserInitialState = {
    name : null,
    email: null,
    type : null
};


const oneUserUpdateUrl = '/api/user/update';

export function fetchOneUserUpdateAsync(id,data){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { 
                    Authorization: `Bearer ${response.data.token}`}
            }
            axios.put(oneUserUpdateUrl+'/'+id,data,config)
            .then((response)=>{
                dispatch(fetchOneUserUpdate(response.data.data))
            })
        })
        .catch((error)=>{
            return null;
        })
    }
}

function fetchOneUserUpdate(data){
    return {
        type: FETCH_USER_UPDATE,
        payload: data
    }
}


export const oneUserReducer = (state=OneUserInitialState,action) =>{
    switch(action.type){
        case FETCH_ONE_USER:
            return action.payload
        case FETCH_USER_UPDATE:
            return action.payload
        default:
            return state;
    }
}


