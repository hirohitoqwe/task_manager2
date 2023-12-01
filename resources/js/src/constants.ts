const ME_INFO_ROUTE: string = "/api/auth/me";
const LOGIN_ROUTE: string = "/api/auth/login";
const LOGOUT_ROUTE: string = "/api/auth/logout";
const REGISTER_ROUTE: string = "/api/user/registration";
const GET_TASK: string = "/api/task/";
const DELETE_TASK: string = "api/task/";
const CREATE_TASK: string = "/api/task/create";
const GET_TEAM: string = "/api/team/";
const CREATE_TEAM: string = "api/team/create";
const LEAVE_TEAM: string = "api/team/leave"
export default {
    LOGOUT: LOGOUT_ROUTE,
    LOGIN: LOGIN_ROUTE,
    ME: ME_INFO_ROUTE,
    REGISTER: REGISTER_ROUTE,
    GET_TASK: GET_TASK,
    GET_TEAM: GET_TEAM,
    CREATE_TASK: CREATE_TASK,
    DELETE_TASK: DELETE_TASK,
    CREATE_TEAM: CREATE_TEAM,
    LEAVE_TEAM: LEAVE_TEAM
}

