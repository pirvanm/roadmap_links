import { INode } from "./INode";
import { ITag } from "./ITag";

export interface IRoadmap
{
    id: number | null;
    tag: ITag,
    mainNode: INode,
    name: string | null;
    status: boolean;
    created_at: string;
}