import { ITag } from "./ITag";

export default interface ILink {
    id: number;
    title: string;
    short_description: string;
    image: string | null;
    link: string;
    difficulty: string;
    type: string;
    status: boolean;
    created_at: string;
    updated_at: string;
    tags: Array<ITag>,
};