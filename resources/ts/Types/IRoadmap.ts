import { INode } from "./INode";
import { ITag } from "./ITag";

export interface IRoadmap
{
    id: number | null;
    tags: ITag[],
    mainNode: INode,
    name: string;
    description: string;
    status: boolean;
    created_at: string;
}