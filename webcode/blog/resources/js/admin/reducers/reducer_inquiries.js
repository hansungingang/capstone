import axios from "axios";
import { FETCH_GET_ALL_INQUIRE,FETCH_GET_ONE_INQUIRE,FETCH_UPDATE_ONE_INQUIRE } from "./types/inquireType";
import { fetchToken } from "./AuthService";

const allInquireUrl = '/api/inquire/get/all';
const oneInquireUrl = '/api/inquire/get';
const oneInquireUpdateUrl = '/api/inquire/update';
const INITIAL_STATE = [];

export function fetchAllInquireAsync(){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` }
            }
            axios.get(allInquireUrl,config)
            .then((response)=>{
                dispatch(receiveAllInquiries(response.data.data))
            })
        })
        .catch((error)=>{
            console.log(error);
            return null;
        })
    }
}

function receiveAllInquiries(data){
    return {
        type: FETCH_GET_ALL_INQUIRE,
        payload: data
    }
}

export const allInquireReducer = (state=INITIAL_STATE,action) =>{
    switch(action.type){
        case FETCH_GET_ALL_INQUIRE:
            return action.payload
        default:
            return state;
    }
}

export function fetchOneInquireAsync(inquireId){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` }
            }
            axios.get(oneInquireUrl+'/'+inquireId,config)
            .then((response)=>{
                dispatch(receiveOneInquire(response.data.data))
            })
        })
        .catch((error)=>{
            console.log(error);
            return null;
        })
    }
}

function receiveOneInquire(data){
    return {
        type: FETCH_GET_ONE_INQUIRE,
        payload: data
    }
}

export function fetchOneInquireUpdateAsync(inquireId,data){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` }
            }
            axios.put(oneInquireUpdateUrl+'/'+inquireId,data,config)
            .then((response)=>{
                dispatch(updateOneInquire(response.data.data))
            })
        })
        .catch((error)=>{
            console.log(error);
            return null;
        })
    }
}

function updateOneInquire(data){
    return {
        type: FETCH_GET_ONE_INQUIRE,
        payload: data
    }
}



export const oneInquireReducer = (state=INITIAL_STATE,action) =>{
    switch(action.type){
        case FETCH_GET_ONE_INQUIRE:
            return action.payload
        case FETCH_UPDATE_ONE_INQUIRE:
            return action.payload
        default:
            return state;
    }
}


