import axios from "axios";
import { FETCH_GET_ALL_ADVERTISE_LOCATIONS,GET_ONE_ADVERTISE_LECTURE_LIST,ADD_LECTURE_TO_ADVERTISE,DELETE_LECTURE_TO_ADVERTISE } from "./types/advertise";
import { fetchToken } from "./AuthService";

const allAdvertiseListUrl = '/api/advertise/get/area/all';
const oneAdvertiseLectureListUrl = '/api/advertise/get';
const INITIAL_STATE = [];

export function fetchAllAdvertiseListAsync(){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` }
            }
            axios.get(allAdvertiseListUrl,config)
            .then((response)=>{
                dispatch(getAllAdvertiseList(response.data.data))
            })
        })
        .catch((error)=>{
            console.log(error);
        })
    }
}

function getAllAdvertiseList(data){
    return {
        type: FETCH_GET_ALL_ADVERTISE_LOCATIONS,
        payload: data
    }
}

export const allAdvertiseListReducer = (state=INITIAL_STATE,action) =>{
    switch(action.type){
        case FETCH_GET_ALL_ADVERTISE_LOCATIONS:
            return action.payload
        default:
            return state;
    }
}

export function fetchOneAdvertiseLectureListAsync(advertiseId){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` }
            }
            axios.get(oneAdvertiseLectureListUrl+'/'+advertiseId,config)
            .then((response)=>{
                dispatch(getOneAdvertiseLectureList(response.data.data))
            })
        })
        .catch((error)=>{
            console.log(error);
        })
    }
}

function getOneAdvertiseLectureList(data){
    return {
        type: ADD_LECTURE_TO_ADVERTISE,
        payload: data
    }
}

const storeLectureToAdvertiseUrl = '/api/advertise/store';


export function storeLectureToAdvertiseAsync(advertiseId, lectureId){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` }
            };
            const data = {lecture_id : lectureId};
            axios.post(storeLectureToAdvertiseUrl+'/'+advertiseId,data,config)
            .then((response)=>{
                dispatch(getAdvertiseLectureList(response.data.data))
            })
        })
        .catch((error)=>{
            console.log(error);
        })
    }
}

function getAdvertiseLectureList(data){
    return {
        type: GET_ONE_ADVERTISE_LECTURE_LIST,
        payload: data
    }
}

const deleteLectureFromAdvertiseUrl = '/api/advertise/delete';

export function deleteLectureToAdvertiseAsync(adMappingId){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` }
            };
            axios.delete(deleteLectureFromAdvertiseUrl+'/'+adMappingId,config)
            .then((response)=>{
                dispatch(deleteAdvertiseLectureList(response.data.data))
            })
        })
        .catch((error)=>{
            console.log(error);
        })
    }
}

function deleteAdvertiseLectureList(data){
    return {
        type: DELETE_LECTURE_TO_ADVERTISE,
        payload: data
    }
}


export const oneAdvertiseLectureListReducer = (state=INITIAL_STATE,action) =>{
    switch(action.type){
        case GET_ONE_ADVERTISE_LECTURE_LIST:
            return action.payload;
        case ADD_LECTURE_TO_ADVERTISE:
            return action.payload;
        case DELETE_LECTURE_TO_ADVERTISE:
            return action.payload;
        default:
            return state;
    }
}


